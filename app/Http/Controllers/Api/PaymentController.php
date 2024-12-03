<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PembayaranModel;
use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // public function __construct()
    // {
    //     $this->middleware(['auth.jwt', 'role:admin'])->only([
    //         'getAllTransactionHistory',
    //     ]);

    //     $this->middleware(['auth.jwt', 'role:user'])->only([
    //         'getTransactionHistory',
    //     ]);
    // }
    public function getTransactionHistory()
    {
        try {
            $user = auth()->user(); // Authenticated user
            // dd($user->role);
            $transactions = $user->role === 'admin'
                ? PembayaranModel::all() // Admin can view all transactions
                : PembayaranModel::where('id', $user->id)->get(); // User's own transactions

            return response()->json(['transactions' => $transactions], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve transaction history', 'message' => $e->getMessage()], 500);
        }
    }
}

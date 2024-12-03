<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PembayaranModel;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['auth.jwt', 'role:user'])->only([
            'getTransactionHistory',
        ]);
    }
    public function getTransactionHistory()
    {
        try {
            $user = auth()->user();
            
            $pembayaran = PembayaranModel::all();

            return response()->json(['request role' => $user->role->role_name,'transactions' => $pembayaran], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve transaction history', 'message' => $e->getMessage()], 500);
        }
    }

    public function verifyPayment($id)
    {
        try {
            $user = auth()->user();
            $pembayaran = PembayaranModel::find($id);
            // if (!$pembayaran) {
            //     return response()->json(['error' => 'Payment not found'], 404);
            // }

            // // Confirm payment
            // $pembayaran->status = 'confirmed';
            // $pembayaran->save();

            return response()->json(['request role' => $user->role->role_name, 'message' => 'Payment verified successfully', 'payment' => $pembayaran], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to verify payment', 'message' => $e->getMessage()], 500);
        }
    }
}

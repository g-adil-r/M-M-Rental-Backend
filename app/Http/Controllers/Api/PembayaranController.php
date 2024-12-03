<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use App\Models\PembayaranModel;
use Illuminate\Http\Request;

class PembayaranController extends Controller
{
    public function __construct()
    {
        $this->middleware(['role:admin'])->only([
            'verifyPayment',
        ]);
    }
    public function getTransactionHistory()
    {
        try {
            $user = auth()->user();
            
            if ($user->role->role_name === "admin") 
                $pembayaran = PembayaranModel::all();
            else {
                $pembayaran = $user->reservations()->with('pembayaran')->get();
            }

            return response()->json(['transactions' => $pembayaran], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to retrieve transaction history', 'message' => $e->getMessage()], 500);
        }
    }

    public function verifyPayment($id)
    {
        try {
            $user = auth()->user();
            $pembayaran = PembayaranModel::find($id);
            if (!$pembayaran) {
                return response()->json(['error' => 'Payment not found'], 404);
            }

            if ($pembayaran->status === 'pending') {
                $pembayaran->status = 'confirmed';
                $pembayaran->save();
            }
            
            return response()->json(['message' => 'Payment verified successfully', 'payment' => $pembayaran], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Failed to verify payment', 'message' => $e->getMessage()], 500);
        }
    }
}

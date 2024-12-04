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

    public function processPayment(Request $request)
    {
        $validatedData = $request->validate([
            'reservation_id' => 'required|exists:reservations,id',
            'payment_method_id' => 'required|exists:metode_pembayaran,id',
            'amount' => 'required|numeric',
        ]);

        try {
            $user = auth()->user();

            $payment = PembayaranModel::create([
                'reservation_id' => $validatedData['reservation_id'],
                'user_id' => $user->id,
                'metode_pembayaran_id' => $validatedData['payment_method_id'],
                'jumlah' => $validatedData['amount'],
                'status' => 'pending',
            ]);

            $payment->save();

            return response()->json(['payment' => $payment], 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Payment processing failed', 'message' => $e->getMessage()], 500);
        }
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

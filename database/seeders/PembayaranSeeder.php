<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $reservasiId = DB::table('reservasi')->pluck('id')->toArray();
        $payments = [
            [
                'id' => Str::uuid()->toString(),
                'reservasi_id' => $reservasiId[0], // Replace with actual reservation IDs if available
                'tanggal_pembayaran' => now(),
                'metode_pembayaran_id' => 1, // Example: Credit Card
                'jumlah' => 500000.00,
                'status' => 'confirmed',
            ],
            [
                'id' => Str::uuid()->toString(),
                'reservasi_id' => $reservasiId[1],
                'tanggal_pembayaran' => now(),
                'metode_pembayaran_id' => 2, // Example: Bank Transfer
                'jumlah' => 750000.00,
                'status' => 'pending',
            ],
            [
                'id' => Str::uuid()->toString(),
                'reservasi_id' => $reservasiId[1],
                'tanggal_pembayaran' => now(),
                'metode_pembayaran_id' => 4, // Example: E-Wallet
                'jumlah' => 300000.00,
                'status' => 'failed',
            ],
        ];

        DB::table('pembayaran')->insert($payments);
    }
}
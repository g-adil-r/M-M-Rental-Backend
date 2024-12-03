<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class MetodePembayaranSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $paymentMethods = [
            ['id' => 1, 'nama_metode' => 'Credit Card'],
            ['id' => 2, 'nama_metode' => 'Bank Transfer'],
            ['id' => 3, 'nama_metode' => 'PayPal'],
            ['id' => 4, 'nama_metode' => 'E-Wallet'],
        ];

        DB::table('metode_pembayaran')->insert($paymentMethods);
    }
}

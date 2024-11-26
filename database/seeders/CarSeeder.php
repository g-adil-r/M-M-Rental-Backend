<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'id' => Str::uuid(),
                'nama_mobil' => 'Toyota Fortuner',
                'tahun' => 2022,
                'plat_nomor' => 'B 1234 XYZ',
                'id_jenis' => 1,
                'kapasitas_penumpang' => 7,
                'harga_sewa' => 750_000,
                'foto' => 'fortuner.jpg',
                'status_id' => 1,
                'transmisi' => 'automatic',
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'id' => Str::uuid(),
                'nama_mobil' => 'Honda Civic',
                'tahun' => 2021,
                'plat_nomor' => 'B 5678 XYZ',
                'id_jenis' => 2,
                'kapasitas_penumpang' => 5,
                'harga_sewa' => 600000,
                'foto' => 'civic.jpg',
                'status_id' => 2,
                'transmisi' => 'manual',
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ];

        DB::table('car')->insert($data);
    }
}

<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class JenisMobilSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //

        $data = [
            ['id' => 1, 'jenis' => 'Sedan'],
            ['id' => 2, 'jenis' => 'SUV'],
            ['id' => 3, 'jenis' => 'MPV'],
            ['id' => 4, 'jenis' => 'Hatchback'],
            ['id' => 5, 'jenis' => 'Coupe'],
            ['id' => 6, 'jenis' => 'Convertible'],
            ['id' => 7, 'jenis' => 'Sport'],
            ['id' => 8, 'jenis' => 'Offroad'],
            ['id' => 9, 'jenis' => 'Pickup'],
            ['id' => 10, 'jenis' => 'Van'],
            ['id' => 11, 'jenis' => 'LCGC'],
            ['id' => 12, 'jenis' => 'Motor'],
        ];

        DB::table('jenis_mobil')->insert($data);
    }
}

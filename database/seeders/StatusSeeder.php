<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StatusSeeder extends Seeder
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
            ['id' => 1, 'status' => 'available'],
            ['id' => 2, 'status' => 'rented'],
            ['id' => 3, 'status' => 'maintenance'],
        ];

        DB::table('status')->insert($data);
    }
}

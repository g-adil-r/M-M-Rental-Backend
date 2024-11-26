<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $seederClasses = [
            RoleSeeder::class,
            StatusSeeder::class,
            JenisMobilSeeder::class,
            UserSeeder::class,
            CarSeeder::class,
        ];

        $this->call($seederClasses);
    }
}

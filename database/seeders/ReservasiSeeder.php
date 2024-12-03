<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ReservasiSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Fetch actual user IDs and car IDs
        $userIds = DB::table('user')->pluck('id')->toArray();
        $carIds = DB::table('car')->pluck('id')->toArray();

        // Check if dependencies exist
        if (empty($userIds) || empty($carIds)) {
            $this->command->warn('No users or cars found. Ensure you seed the user and car tables first.');
            return;
        }

        // Example reservations
        $reservations = [
            [
                'id' => Str::uuid()->toString(),
                'user_id' => $userIds[0], // Use the first available user ID
                'car_id' => $carIds[0],  // Use the first available car ID
                'start_date' => now(),
                'end_date' => now()->addDays(3),
                'total_harga' => 1500000.00,
                'status' => 'pending',
            ],
            [
                'id' => Str::uuid()->toString(),
                'user_id' => $userIds[1], // Use another or fallback
                'car_id' => $carIds[1],   // Use another or fallback
                'start_date' => now(),
                'end_date' => now()->addDays(5),
                'total_harga' => 2500000.00,
                'status' => 'on_rent',
            ],
        ];

        // Insert reservations into the database
        DB::table('reservasi')->insert($reservations);
    }
}

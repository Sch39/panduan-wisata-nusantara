<?php

namespace Database\Seeders;

use App\Models\DestinationTravelStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationTravelStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DestinationTravelStyle::insert([
            [
                'destination_id' => 1,
                'travel_style_id' => 1,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'destination_id' => 1,
                'travel_style_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'destination_id' => 2,
                'travel_style_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'destination_id' => 2,
                'travel_style_id' => 3,
                'created_at' => now(),
                'updated_at' => now(),
            ],
        ]);
    }
}

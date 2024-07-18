<?php

namespace Database\Seeders;

use App\Models\TravelStyle;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TravelStyleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        TravelStyle::insert([
            [
                'name' => 'Museum',
            ],
            [
                'name' => 'Adventure',
            ],
            [
                'name' => 'Mountain',
            ],
        ]);
    }
}

<?php

namespace Database\Seeders;

use App\Models\Destinations;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'id' => 1,
                'slug' => 'prambanan',
                'regency' => 'Sleman',
            ],
            [
                'id' => 2,
                'slug' => 'borobudor',
                'regency' => 'Magelang',
            ]
        ];
        Destinations::insert($data);
    }
}

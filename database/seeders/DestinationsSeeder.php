<?php

namespace Database\Seeders;

use App\Models\Destination;
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
            ],
            [
                'id' => 2,
                'slug' => 'borobudor',
            ],
        ];
        // Destination::insert($data);
        foreach ($data as $destination) {
            Destination::create($destination);
        }
    }
}

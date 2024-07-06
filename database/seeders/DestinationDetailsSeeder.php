<?php

namespace Database\Seeders;

use App\Models\DestinationDetails;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationDetailsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $data = [
            [
                'language_code' => 'en',
                'title' => 'Prambanan Temple',
                'html_content' => '<h1>Prambanan Temple Content</h1>',
                'destination_id' => 1,
            ],
            [
                'language_code' => 'id',
                'title' => 'Candi Prambanan',
                'html_content' => '<h1>Konten Candi Prambanan</h1>',
                'destination_id' => 1,
            ],
            [
                'language_code' => 'id',
                'title' => 'Candi Borobudor',
                'html_content' => '<h1>Konten Candi Borobudor</h1>',
                'destination_id' => 2,
            ],
            [
                'language_code' => 'en',
                'title' => 'Borobudor Temple',
                'html_content' => '<h1>Borobudor Temple Content</h1>',
                'destination_id' => 2,
            ],
        ];

        DestinationDetails::insert($data);
    }
}

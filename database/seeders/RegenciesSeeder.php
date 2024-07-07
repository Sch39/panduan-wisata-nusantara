<?php

namespace Database\Seeders;

use App\Models\Regencies;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RegenciesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvFile = base_path('database/seeders/static-data/regencies.csv');

        // Open and read the CSV file
        $file = fopen($csvFile, 'r');
        if ($file === false) {
            throw new \Exception('Could not open the CSV file');
        }

        // Skip the header row
        fgetcsv($file);

        // Loop through each row of the CSV file
        while (($row = fgetcsv($file, 1000, ',')) !== false) {
            // Insert data into the provinces table
            Regencies::insert([
                'code' => $row[0],
                'provinces_code' => $row[1],
                'language_code' => $row[2],
                'name' => $row[3],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        // Close the CSV file
        fclose($file);
    }
}
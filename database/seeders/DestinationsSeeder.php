<?php

namespace Database\Seeders;

use App\Models\Destination;
use App\Models\DestinationDetail;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class DestinationsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // $data = [
        //     [
        //         'slug' => 'prambanan',
        //     ],
        //     [
        //         'slug' => 'borobudor',
        //     ],
        // ];
        // // Destination::insert($data);
        // foreach ($data as $destination) {
        //     Destination::create($destination);
        // }

        $faker = Faker::create();

        for ($i = 0; $i < 20; $i++) {
            $destination = Destination::create([
                'slug' => $faker->slug,
            ]);

            DestinationDetail::create([
                'language_code' => 'id',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 1,
            ]);
            DestinationDetail::create([
                'language_code' => 'en',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 515,
            ]);
        }


        for ($i = 0; $i < 20; $i++) {
            $destination = Destination::create([
                'slug' => $faker->slug,
            ]);

            DestinationDetail::create([
                'language_code' => 'id',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 3,
            ]);
            DestinationDetail::create([
                'language_code' => 'en',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 517,
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $destination = Destination::create([
                'slug' => $faker->slug,
            ]);

            DestinationDetail::create([
                'language_code' => 'id',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 30,
            ]);
            DestinationDetail::create([
                'language_code' => 'en',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 544,
            ]);
        }

        for ($i = 0; $i < 20; $i++) {
            $destination = Destination::create([
                'slug' => $faker->slug,
            ]);

            DestinationDetail::create([
                'language_code' => 'id',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 33,
            ]);
            DestinationDetail::create([
                'language_code' => 'en',
                'title' => $faker->sentence,
                'image_url' => '/assets/images/volcano-with-mist-sunset.jpg',
                'description' => $faker->paragraph,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'regency_id' => 547,
            ]);
        }
    }
}

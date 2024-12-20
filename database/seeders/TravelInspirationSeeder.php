<?php

namespace Database\Seeders;

use App\Models\DestinationDetail;
use App\Models\TravelInspiration;
use App\Models\TravelInspirationSlug;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Faker\Factory as Faker;

class TravelInspirationSeeder extends Seeder
{

    public function run(): void
    {
        $faker = Faker::create();

        // function getRandImage()
        // {
        //     return '/assets/images/destinations/' . rand(1, 4) . '.jpg';
        // }

        for ($i = 0; $i < 5; $i++) {
            $travelInspirationSlug = TravelInspirationSlug::create(['slug' => $faker->slug]);

            $destination = DestinationDetail::findOrFail($i + 1);
            $imageUrl = getRandImage();
            TravelInspiration::create([
                'language_code' => 'id',
                'title' => $destination->title,
                'author' => $faker->name,
                'image_url' => $imageUrl,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'travel_inspiration_slug_id' => $travelInspirationSlug->id,
            ]);
            TravelInspiration::create([
                'language_code' => 'en',
                'title' => $destination->title,
                'author' => $faker->name,
                'image_url' => $imageUrl,
                'html_content' => '<p>' . $faker->paragraph . '</p>',
                'destination_id' => $destination->id,
                'travel_inspiration_slug_id' => $travelInspirationSlug->id,
            ]);
        }
    }
}

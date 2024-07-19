<?php

namespace Database\Seeders;

use App\Models\DestinationVote;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DestinationVoteSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // DestinationVote::insert([
        //     [
        //         'user_id' => 2,
        //         'destination_id' => 1,
        //         'rating' => 4.7,
        //     ],
        //     [
        //         'user_id' => 2,
        //         'destination_id' => 2,
        //         'rating' => 4.2,
        //     ],
        //     [

        //     ]
        // ]);


        for ($i = 1; $i < 4; $i++) {
            for ($j = 1; $j < 25; $j++) {
                DestinationVote::create([
                    'user_id' => $i,
                    'destination_id' => $j,
                    'rating' => rand(0, 5)
                ]);
            }
        }
    }
}

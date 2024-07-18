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
        DestinationVote::insert([
            [
                'user_id' => 2,
                'destination_id' => 1,
                'rating' => 4.7,
            ],
            [
                'user_id' => 2,
                'destination_id' => 2,
                'rating' => 4.2,
            ],
        ]);
    }
}

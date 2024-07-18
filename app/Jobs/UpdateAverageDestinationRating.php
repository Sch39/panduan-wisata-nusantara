<?php

namespace App\Jobs;

use App\Models\DestinationRating;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class UpdateAverageDestinationRating implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $chunkSize = 50;
        DestinationRating::with('votes')->chunk($chunkSize, function ($ratings) {
            foreach ($ratings as $rating) {
                $rating->avg_rating = $rating->votes->avg('rating');
                $rating->save();
            }
        });
    }
}

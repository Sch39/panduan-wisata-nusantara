<?php

namespace App\Http\Controllers;

use App\Models\Destination;
use Illuminate\Http\Request;
use Inertia\Inertia;

use function PHPUnit\Framework\isEmpty;

class DestinationDetailController extends Controller
{
    public function show($locale, $slug, Request $request)
    {
        $destination = Destination::select(['id', 'slug'])
            ->where('slug', $slug)
            ->with(['destinationDetails' => function ($q) use ($locale) {
                $q->where('language_code', $locale);
            }, 'destinationDetails.regency:id,name,code,provinces_code', 'destinationDetails.regency.province' => function ($q) use ($locale) {
                $q->where('language_code', $locale);
            }, 'votes', 'votes.user', 'rating'])
            ->first();
        if (!$destination) {
            return to_route('Error.404');
        }
        $previousUrl = $request->query('from', '/');
        // return $destination;
        return Inertia::render('Destinations/DestinationDetail', [
            'destination_detail' => $destination,
            'previous_url' => $previousUrl,
        ]);
    }
}

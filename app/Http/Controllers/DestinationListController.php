<?php

namespace App\Http\Controllers;

use App\Models\DestinationDetail;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DestinationListController extends Controller
{
    public function show($locale, $postal_code)
    {
        $province_code = substr($postal_code, 0, 2);
        $regency_code = substr($postal_code, 2, 2);

        $destinations = DestinationDetail::where('language_code', $locale)
            ->with(['destination:id,slug', 'regency', 'destination.rating:id,destination_id,avg_rating', 'regency.province' => function ($q) use ($locale) {
                $q->where('language_code', $locale);
            }])
            ->whereHas('regency', function ($query) use ($regency_code) {
                $query->where('code', $regency_code);
            })
            ->paginate(8);

        // return $destinations;
        return Inertia::render('Destinations/DestinationList', [
            'destinations_pagination' => $destinations,
        ]);
    }
}

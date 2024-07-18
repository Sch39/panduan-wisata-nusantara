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

        $destinations = DestinationDetail::with(['destination:id,slug', 'regency:id,name,provinces_code', 'destination.rating:id,destination_id,avg_rating', 'regency.province:id,name,code'])
            ->where('language_code', $locale)
            ->whereHas('regency', function ($query) use ($regency_code) {
                $query->where('code', $regency_code);
            })
            // ->with(['destination.rating:id,destination_id,avg_rating', 'regency.province:id,name,code'])
            ->paginate(8);
        return Inertia::render('Destinations/DestinationList', [
            'destinations_pagination' => $destinations,
        ]);
    }
}

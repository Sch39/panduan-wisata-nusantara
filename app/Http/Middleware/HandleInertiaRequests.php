<?php

namespace App\Http\Middleware;

use App\Models\DestinationDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\File;
use Inertia\Middleware;

class HandleInertiaRequests extends Middleware
{
    /**
     * The root template that's loaded on the first page visit.
     *
     * @see https://inertiajs.com/server-side-setup#root-template
     *
     * @var string
     */
    protected $rootView = 'app';

    /**
     * Determines the current asset version.
     *
     * @see https://inertiajs.com/asset-versioning
     */
    public function version(Request $request): ?string
    {
        return parent::version($request);
    }

    /**
     * Define the props that are shared by default.
     *
     * @see https://inertiajs.com/shared-data
     *
     * @return array<string, mixed>
     */
    public function share(Request $request): array
    {
        $file = lang_path(App::currentLocale() . ".json");
        $destinations = Cache::remember('destinations', 30, fn () => DestinationDetail::select('id', 'language_code', 'regency_id')
            ->with(['regency' => function ($query) {
                $query->select('id', 'name', 'code', 'provinces_code')
                    ->with(['province' => function ($query) {
                        $query->select('id', 'code', 'name');
                    }]);
            }])
            ->take(10)
            ->get());
        // dd($destinations->filter(fn ($item) => $item['language_code'] === App::currentLocale())->values()->toJson());
        return array_merge(parent::share($request), [
            'csrf' => csrf_token(),
            'locale' => App::currentLocale(),
            'locales' => config('app.available_locales'),
            'translations' => File::exists($file) ? File::json($file) : [],
            'destinations' =>  $destinations->filter(fn ($item) => $item['language_code'] === App::currentLocale())->values(),
        ]);
    }
}

<?php
namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;

class SetLocale
{
    // public function handle(Request $request, Closure $next)
    // {
    //     // // Get locale from URL segment
    //     // $locale = $request->segment(1);

    //     // // Available languages
    //     // $availableLocales = ['fr', 'ar'];

    //     // // Set locale if valid, otherwise default to French
    //     // if (in_array($locale, $availableLocales)) {
    //     //     App::setLocale($locale);
    //     //     Session::put('locale', $locale);
    //     // } else {
    //     //     App::setLocale('fr');
    //     // }

    //     // return $next($request);

    //     // Get locale from session, query param, or use default
    //     $locale = session('locale') ?? request('locale') ?? config('app.locale');

    //     // Validate locale is supported
    //     if (in_array($locale, config('app.supported_locales'))) {
    //         app()->setLocale($locale);
    //         session(['locale' => $locale]);
    //     }

    //     return $next($request);

    // }

    public function handle(Request $request, Closure $next)
    {
        $locale = session('locale');

        if ($locale && in_array($locale, ['fr', 'ar'])) {
            app()->setLocale($locale);
        }

        return $next($request);
    }
}

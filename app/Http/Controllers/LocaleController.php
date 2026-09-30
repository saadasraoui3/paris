<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocaleController extends Controller
{
   public function changeLocale($locale)
    {
        if (in_array($locale, config('app.supported_locales'))) {
            session(['locale' => $locale]);
        }

        return redirect()->back();
    }
}

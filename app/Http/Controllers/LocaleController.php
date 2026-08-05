<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocaleController extends Controller
{
    //

    public function lang($locale)

    {

        if (!in_array($locale, ['fr', 'en'])) {
            abort(404);
        }

        App::setLocale($locale);

        session()->put('locale', $locale);

        return redirect()->back();

    }

}

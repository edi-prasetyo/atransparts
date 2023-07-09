<?php

namespace App\Http\Controllers\Frontend;

use App\Http\Controllers\Controller;
use App\Models\About;
use Illuminate\Http\Request;

class AboutController extends Controller
{
    function index()
    {
        $locale = app()->currentLocale();
        $about =  About::with(['aboutTranslations' => function ($query) use ($locale) {
            $query->where('locale', $locale);
        }])->first();

        return view('frontend.about.index', compact('about'));
    }
}

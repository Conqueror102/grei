<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Project;

class HomeController extends Controller
{
    public function __invoke()
    {
        return view('pages.home', [
            'homeProperties' => Listing::published()->where('kind', 'property')->with('media')->orderByDesc('featured')->latest()->limit(6)->get(),
            'homeStays' => Listing::published()->where('kind', 'stay')->with('media')->orderByDesc('featured')->latest()->limit(3)->get(),
            'homeProjects' => Project::published()->with('media')->orderByDesc('featured')->latest()->limit(2)->get(),
        ]);
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Project;
use App\Services\StayAvailability;
use Illuminate\Http\Request;

class SpaceController extends Controller
{
    public function property(Listing $listing)
    {
        abort_unless($listing->isPublic() && $listing->kind === 'property', 404);
        return view('pages.property-show', ['listing' => $listing->load('media')]);
    }

    public function stay(Listing $listing)
    {
        abort_unless($listing->isPublic() && $listing->kind === 'stay', 404);
        return view('pages.stay-show', ['listing' => $listing->load('media')]);
    }

    public function project(Project $project)
    {
        abort_unless($project->isPublic(), 404);
        return view('pages.project-show', ['project' => $project->load('media')]);
    }

    public function availability(Request $request, Listing $listing, StayAvailability $availability)
    {
        $input = $request->validate(['checkin' => 'required|string', 'checkout' => 'required|string', 'guests' => 'required|integer|min:1|max:50']);
        return response()->json($availability->check($listing, $input['checkin'], $input['checkout'], (int) $input['guests']));
    }
}

<?php

namespace App\Http\Controllers;

use App\Models\Project;

class DesignController extends Controller
{
    public function index() { return view('pages.design', ['projects'=>Project::published()->with('media')->orderByDesc('featured')->latest()->limit(4)->get()]); }
    public function service(string $service) {
        abort_unless(array_key_exists($service,config('grei.design_services')),404);
        return view('pages.design-service',['service'=>config('grei.design_services.'.$service),'serviceKey'=>$service]);
    }
}

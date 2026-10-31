<?php

namespace App\Http\Controllers;

use App\Models\Listing;
use App\Models\Project;
use Illuminate\Http\Request;

class ContactController extends Controller
{
    public function __invoke(Request $request) {
        $data=$request->validate(['service'=>'nullable|in:property,stay,design,general','listing'=>'nullable|integer','project'=>'nullable|integer','checkin'=>'nullable|date_format:Y-m-d','checkout'=>'nullable|date_format:Y-m-d','guests'=>'nullable|integer|min:1|max:50']);
        $listing=empty($data['listing'])?null:Listing::published()->find($data['listing']);
        $project=empty($data['project'])?null:Project::published()->find($data['project']);
        return view('pages.contact',[
            'service'=>$listing?($listing->kind==='stay'?'stay':'property'):($project?'design':($data['service']??'general')),
            'listing'=>$listing,'project'=>$project,'checkin'=>$data['checkin']??'','checkout'=>$data['checkout']??'','guests'=>$data['guests']??null,
            'message'=>$listing?'I’m interested in '.$listing->title.'. Please share more details.':($project?'I like the '.$project->title.' direction. I’d love to discuss a design project.':''),
        ]);
    }
}

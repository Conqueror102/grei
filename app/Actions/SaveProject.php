<?php

namespace App\Actions;

use App\Models\Project;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SaveProject
{
    public function handle(array $input, ?Project $project=null): Project
    {
        Gate::authorize('access-admin');
        $rules=['title'=>'required|string|min:2|max:160','slug'=>['required','alpha_dash','max:180',Rule::unique('projects','slug')->ignore($project?->id)],'category'=>'required|in:residential,commercial,styling','location'=>'nullable|string|max:100','year'=>'nullable|integer|min:1900|max:'.(now()->year+1),'summary'=>'required_if:form.status,published|nullable|string|max:600','story'=>'required_if:form.status,published|nullable|string|max:20000','approach'=>'nullable|string|max:12000','services_text'=>'nullable|string|max:3000','materials_text'=>'nullable|string|max:3000','cover_asset'=>'nullable|in:assets/soft-geometry.webp,assets/the-social-room.webp,assets/city-apartment.webp','status'=>'required|in:draft,published','featured'=>'boolean','is_demo'=>'boolean'];
        $data=Validator::make(['form'=>$input],collect($rules)->mapWithKeys(fn($rule,$key)=>['form.'.$key=>$rule])->all())->validate()['form'];
        if($data['status']==='published'&&!$data['is_demo']&&!$project?->media()->where('kind','image')->exists())throw ValidationException::withMessages(['form.status'=>'Save a draft and add actual project photographs before publishing.']);
        foreach(['services','materials'] as $field){$data[$field]=array_values(array_unique(array_filter(array_map('trim',preg_split('/\r?\n/',$data[$field.'_text']??'')))));if(count($data[$field])>30||collect($data[$field])->contains(fn($v)=>mb_strlen($v)>100))throw ValidationException::withMessages(['form.'.$field.'_text'=>'Use at most 30 entries, with up to 100 characters each.']);unset($data[$field.'_text']);}
        $data['summary']=$data['summary']??'';$data['story']=$data['story']??'';
        $data['cover_asset']=$data['is_demo']?(($data['cover_asset']??null)?:'assets/soft-geometry.webp'):null;
        $project??=new Project();$project->fill($data);$project->save();return $project;
    }
}

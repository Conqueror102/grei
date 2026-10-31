<?php

namespace App\Actions;

use App\Models\Listing;
use App\Services\VideoEmbed;
use Illuminate\Support\Facades\Gate;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class SaveListing
{
    public function handle(array $input, ?Listing $listing=null): Listing
    {
        Gate::authorize('access-admin');
        $rules=[
            'title'=>'required|string|min:2|max:160','slug'=>['required','alpha_dash','max:180',Rule::unique('listings','slug')->ignore($listing?->id)],
            'kind'=>'required|in:property,stay','category'=>'required|in:sale,rent,investment,stay','property_type'=>'required|in:'.implode(',',array_keys(config('grei.property_types'))),
            'location'=>'required|string|max:100','address'=>'nullable|string|max:255','summary'=>'required_if:form.status,published|nullable|string|max:600','description'=>'required_if:form.status,published|nullable|string|max:20000',
            'bedrooms'=>'required|integer|min:0|max:50','bathrooms'=>'required|integer|min:0|max:50','guest_capacity'=>'nullable|required_if:form.kind,stay|integer|min:1|max:50','area_sqm'=>'nullable|numeric|min:0|max:100000000',
            'price'=>['nullable','numeric','min:0','max:1000000000000','regex:/^\d{1,13}(?:\.\d{1,2})?$/'],'currency'=>'required|in:NGN,USD,GBP,EUR','price_period'=>'nullable|in:night,month,year',
            'min_nights'=>'required|integer|min:1|max:365','max_nights'=>'required|integer|gte:form.min_nights|max:365',
            'amenities_text'=>'nullable|string|max:3000','cover_asset'=>'nullable|in:assets/courtyard-exterior.webp,assets/city-apartment.webp,assets/courtyard-residence.webp,assets/slow-morning.webp',
            'video_url'=>'nullable|url:https|max:1000','status'=>'required|in:draft,published','featured'=>'boolean','is_demo'=>'boolean',
        ];
        $data=Validator::make(['form'=>$input],collect($rules)->mapWithKeys(fn($rule,$key)=>['form.'.$key=>$rule])->all())->validate()['form'];
        if(($data['kind']==='stay')!==($data['category']==='stay')) throw ValidationException::withMessages(['form.category'=>'Choose “Stay” for furnished stays, or a property category for sale/rental listings.']);
        if(!empty($data['video_url'])&&!VideoEmbed::url($data['video_url']))throw ValidationException::withMessages(['form.video_url'=>'Use a valid YouTube or Vimeo HTTPS video link.']);
        if($data['status']==='published'&&!$data['is_demo']&&!$listing?->media()->where('kind','image')->exists())throw ValidationException::withMessages(['form.status'=>'Save a draft and upload at least one actual property image before publishing.']);
        $amenities=array_values(array_unique(array_filter(array_map('trim',preg_split('/\r?\n/',$data['amenities_text']??'')))));
        if(count($amenities)>40||collect($amenities)->contains(fn($item)=>mb_strlen($item)>80))throw ValidationException::withMessages(['form.amenities_text'=>'Use at most 40 amenities, with up to 80 characters per line.']);
        $price=$data['price']??'';
        $parts=explode('.',(string)$price);
        $data['price_minor']=$price===''||$price===null?null:((int)$parts[0]*100+(int)str_pad($parts[1]??'',2,'0'));
        $data['amenities']=$amenities;
        $data['summary']=$data['summary']??''; $data['description']=$data['description']??'';
        $data['cover_asset']=$data['is_demo']?(($data['cover_asset']??null)?:'assets/courtyard-exterior.webp'):null;
        if($data['kind']==='stay')$data['price_period']='night';
        unset($data['price'],$data['amenities_text']);
        $listing??=new Listing(); $listing->fill($data); $listing->save(); return $listing;
    }
}

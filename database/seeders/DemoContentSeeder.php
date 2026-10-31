<?php

namespace Database\Seeders;

use App\Models\Listing;
use App\Models\Project;
use Illuminate\Database\Seeder;

class DemoContentSeeder extends Seeder
{
    public function run(): void
    {
        $properties = [
            ['the-courtyard-house','The Courtyard House','sale','house','Garden District',4,4,18500000000,'assets/courtyard-exterior.webp',['Garden','Parking','Balcony','Security']],
            ['the-city-apartment','The City Apartment','rent','apartment','City Centre',2,2,1200000000,'assets/city-apartment.webp',['Wi-Fi','Equipped kitchen','Air conditioning','Workspace']],
            ['the-coastal-retreat','The Coastal Retreat','investment','house','Coastal District',3,3,24000000000,'assets/courtyard-residence.webp',['Swimming pool','Garden','Parking','Security']],
            ['the-garden-apartment','The Garden Apartment','sale','apartment','Garden District',2,2,9500000000,'assets/city-apartment.webp',['Balcony','Parking','Security']],
        ];
        foreach ($properties as [$slug,$title,$category,$type,$location,$beds,$baths,$price,$cover,$amenities]) {
            Listing::firstOrCreate(['slug'=>$slug], [
                'title'=>$title,'kind'=>'property','category'=>$category,'property_type'=>$type,'location'=>$location,
                'bedrooms'=>$beds,'bathrooms'=>$baths,'price_minor'=>$price,'currency'=>'NGN','price_period'=>$category==='rent'?'year':null,
                'summary'=>'A concept collection study exploring light, natural materials and a considered way of living.',
                'description'=>'A visual exploration of the space a new chapter could take. Natural light, tactile materials and a connection to the outdoors shape this architectural direction.\n\nThis is an illustrative listing. Location labels, specifications and pricing are demonstration content, not an offer of a real property. Ask GREI for current verified listings.',
                'area_sqm'=>$type==='house'?320:145,'cover_asset'=>$cover,'amenities'=>$amenities,'status'=>'published','featured'=>true,'is_demo'=>true,
            ]);
        }
        foreach ([['courtyard-stay','The Courtyard Stay','Garden District',3,6,21000000,'assets/courtyard-residence.webp'],['city-stay','The City Stay','City Centre',2,4,16500000,'assets/city-apartment.webp'],['slow-morning-suite','The Slow Morning Suite','Garden District',1,2,11000000,'assets/slow-morning.webp']] as [$slug,$title,$location,$beds,$guests,$price,$cover]) {
            Listing::firstOrCreate(['slug'=>$slug], [
                'title'=>$title,'kind'=>'stay','category'=>'stay','property_type'=>'apartment','location'=>$location,
                'bedrooms'=>$beds,'bathrooms'=>$beds,'guest_capacity'=>$guests,'price_minor'=>$price,'currency'=>'NGN','price_period'=>'night',
                'summary'=>'Room to settle in. A furnished-stay concept for your own pace and your own plans.',
                'description'=>'Thoughtful furniture, space to gather and a quiet place to rest. This concept explores the comfort of a home away from home.\n\nAll imagery, amenities, districts and rates shown are illustrative. GREI confirms the actual apartment, final rate and amenities before any reservation.',
                'cover_asset'=>$cover,'amenities'=>['Wi-Fi','Equipped kitchen','Air conditioning','Workspace','Housekeeping'],'status'=>'published','featured'=>true,'is_demo'=>true,
            ]);
        }
        foreach ([['soft-geometry','Soft geometry.','residential','assets/soft-geometry.webp',['Travertine','Walnut','Textured plaster','Rust velvet']],['the-social-room','The social room.','commercial','assets/the-social-room.webp',['Oxblood upholstery','Brushed metal','Walnut','Expressive art']]] as [$slug,$title,$category,$cover,$materials]) {
            Project::firstOrCreate(['slug'=>$slug], [
                'title'=>$title,'category'=>$category,'summary'=>'An exploration of space, character and the way a room makes you feel.',
                'story'=>'A design concept built around people. We explore the relationship between sculptural forms, honest materials and the rhythm of everyday life. This is a concept study, not a documented completed GREI commission.',
                'approach'=>'Consider the way people move, gather and pause. Then bring light, texture and a few unexpected pairings into a clear spatial direction.',
                'services'=>['Spatial direction','Material selection','Furniture and lighting','Styling and finishing'],'materials'=>$materials,
                'cover_asset'=>$cover,'status'=>'published','featured'=>true,'is_demo'=>true,
            ]);
        }
    }
}

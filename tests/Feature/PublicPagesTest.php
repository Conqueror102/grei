<?php
namespace Tests\Feature;
use App\Models\Listing;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

class PublicPagesTest extends TestCase {
    use RefreshDatabase;
    public static function pages():array{return array_map(fn($url)=>[$url],['/','/properties','/properties/the-courtyard-house','/stays','/stays/courtyard-stay','/design','/design/projects','/design/projects/soft-geometry','/design/services/residential','/design/services/commercial','/design/services/styling','/design/consultation','/about','/contact','/privacy','/terms','/admin/login','/admin/forgot-password']);}
    #[DataProvider('pages')] public function test_public_pages_render(string $url):void{$this->seed(DemoContentSeeder::class);$this->get($url)->assertOk();}
    public function test_drafts_archives_and_disabled_demo_records_are_not_public():void{
        $this->seed(DemoContentSeeder::class);$listing=Listing::first();$listing->update(['status'=>'draft']);$this->get('/properties/'.$listing->slug)->assertNotFound();$listing->update(['status'=>'published']);$listing->delete();$this->get('/properties/'.$listing->slug)->assertNotFound();$listing->restore();config(['grei.show_demo'=>false]);$this->get('/properties/'.$listing->slug)->assertNotFound();
    }
    public function test_route_kinds_cannot_be_swapped():void{$this->seed(DemoContentSeeder::class);$this->get('/stays/the-courtyard-house')->assertNotFound();$this->get('/properties/courtyard-stay')->assertNotFound();}
    public function test_unknown_and_array_search_parameters_have_safe_responses():void{$this->get('/properties?location[]=bad')->assertStatus(400);$this->get('/design/services/missing')->assertNotFound();$this->get('/stays/no-such-stay')->assertNotFound();}
}

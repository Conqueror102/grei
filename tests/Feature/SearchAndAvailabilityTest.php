<?php
namespace Tests\Feature;
use App\Models\Listing;
use App\Services\StayAvailability;
use Carbon\CarbonImmutable;
use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Validation\ValidationException;
use Livewire\Livewire;
use Tests\TestCase;

class SearchAndAvailabilityTest extends TestCase {
    use RefreshDatabase;
    protected function setUp():void{parent::setUp();$this->seed(DemoContentSeeder::class);$this->travelTo(CarbonImmutable::parse('2026-10-30 12:00:00','Africa/Lagos'));}
    public function test_property_filters_work_together_and_reset():void{
        Livewire::test('pages::property-index')->set('location','Garden District')->set('property_type','house')->set('category','sale')->set('bedrooms','4')->set('min_price','180000000')->set('max_price','200000000')->call('applyFilters')->assertHasNoErrors()->assertSee('The Courtyard House')->assertDontSee('The City Apartment')->assertDontSee('The Coastal Retreat')->call('resetFilters')->assertSee('The City Apartment')->assertSee('The Coastal Retreat');
    }
    public function test_search_restores_url_filters_and_has_empty_state():void{$this->get('/properties?category=rent')->assertOk()->assertSee('The City Apartment')->assertDontSee('The Courtyard House');Livewire::test('pages::property-index')->set('location','Unknown location')->call('applyFilters')->assertSee('Your space is still out there.');}
    public function test_invalid_budget_shows_validation():void{Livewire::test('pages::property-index')->set('min_price','200')->set('max_price','100')->call('applyFilters')->assertHasErrors('max_price');}
    public function test_blocked_dates_are_excluded_and_checkout_boundaries_are_open():void{
        $stay=Listing::where('slug','courtyard-stay')->firstOrFail();$stay->blocks()->create(['starts_on'=>'2026-11-05','ends_on'=>'2026-11-10']);$service=app(StayAvailability::class);
        $this->assertFalse($service->check($stay,'2026-11-04','2026-11-06',2)['available']);
        $this->assertFalse($service->check($stay,'2026-11-06','2026-11-08',2)['available']);
        $this->assertFalse($service->check($stay,'2026-11-01','2026-11-15',2)['available']);
        $this->assertTrue($service->check($stay,'2026-11-01','2026-11-05',2)['available']);
        $this->assertTrue($service->check($stay,'2026-11-10','2026-11-12',2)['available']);
        Livewire::test('pages::stay-index')->set('checkin','2026-11-06')->set('checkout','2026-11-08')->call('search')->assertDontSee('The Courtyard Stay')->assertSee('The City Stay');
    }
    public function test_availability_checks_capacity_and_date_order():void{$stay=Listing::where('slug','city-stay')->firstOrFail();$this->getJson('/stays/'.$stay->slug.'/availability?checkin=2026-11-05&checkout=2026-11-04&guests=2')->assertUnprocessable()->assertJsonValidationErrors('checkout');$this->getJson('/stays/'.$stay->slug.'/availability?checkin=2026-11-05&checkout=2026-11-07&guests=50')->assertUnprocessable()->assertJsonValidationErrors('guests');}
    public function test_minimum_maximum_nights_and_estimate():void{$stay=Listing::where('slug','city-stay')->firstOrFail();$stay->update(['min_nights'=>2,'max_nights'=>4]);$result=app(StayAvailability::class)->check($stay,'2026-11-05','2026-11-08',3);$this->assertSame(3,$result['nights']);$this->assertSame($stay->price_minor*3,$result['total_minor']);$this->expectException(ValidationException::class);app(StayAvailability::class)->check($stay,'2026-11-05','2026-11-06',2);}
    public function test_project_category_filter():void{Livewire::test('pages::project-index')->set('category','commercial')->assertSee('The social room.')->assertDontSee('Soft geometry.');}
}

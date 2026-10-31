<?php

namespace Tests\Feature;

use Database\Seeders\DemoContentSeeder;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class ArchitecturalLivingEnhancementsTest extends TestCase
{
    use RefreshDatabase;

    protected function setUp(): void
    {
        parent::setUp();
        $this->seed(DemoContentSeeder::class);
    }

    public function test_property_page_renders_materials_neighborhood_and_objects(): void
    {
        $response = $this->get('/properties/the-courtyard-house');

        $response->assertOk()
            ->assertSee('Tactile Material Language')
            ->assertSee('The rhythm of')
            ->assertSee('neighbourhood.')
            ->assertSee('The GREI Edit / Objects in this space')
            ->assertSee('Enquire to source')
            ->assertSee('Roman Travertine')
            ->assertSee('Smoked French Oak');
    }

    public function test_stay_page_renders_stay_rituals_materials_and_objects(): void
    {
        $response = $this->get('/stays/courtyard-stay');

        $response->assertOk()
            ->assertSee('The In-Residence Experience')
            ->assertSee('The Dawn Light')
            ->assertSee('The Botanical Bath')
            ->assertSee('Tactile Material Language')
            ->assertSee('The GREI Edit / Objects in this space')
            ->assertSee('Enquire to source');
    }

    public function test_design_project_page_renders_palette_and_curated_objects(): void
    {
        $response = $this->get('/design/projects/soft-geometry');

        $response->assertOk()
            ->assertSee('Material Palette')
            ->assertSee('The GREI Edit / Objects in this space')
            ->assertSee('Enquire to source');
    }

    public function test_about_page_renders_five_architectural_tenets(): void
    {
        $response = $this->get('/about');

        $response->assertOk()
            ->assertSee('The Architectural Standard')
            ->assertSee('Five tenets of every')
            ->assertSee('Natural Light First')
            ->assertSee('Material Honesty')
            ->assertSee('Acoustic Calm')
            ->assertSee('Spatial Proportion')
            ->assertSee('Turnkey Serenity');
    }

    public function test_design_studio_renders_collaborative_journey_and_spatial_curator(): void
    {
        $response = $this->get('/design');

        $response->assertOk()
            ->assertSee('The Collaborative Journey')
            ->assertSee('01 / DISCOVERY')
            ->assertSee('Curate your')
            ->assertSee('atmosphere.')
            ->assertSee('The Raw Monolith')
            ->assertSee('The Tactile Sanctuary')
            ->assertSee('The Nightfall Salon')
            ->assertSee('Commission this Spatial Direction');
    }

    public function test_homepage_renders_solar_dial_and_links(): void
    {
        $response = $this->get('/');

        $response->assertOk()
            ->assertSee('Spaces sculpted')
            ->assertSee('The Architecture of Light')
            ->assertSee('Dawn Mist')
            ->assertSee('High Noon')
            ->assertSee('Golden Hour')
            ->assertSee('Nightfall')
            ->assertSee(route('properties.index'))
            ->assertSee(route('stays.index'))
            ->assertSee(route('projects.index'));
    }
}

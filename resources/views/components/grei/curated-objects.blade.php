@props(['spaceTitle' => 'this space'])

@php
    $objects = [
        [
            'name' => 'The Fluted Travertine Dish',
            'category' => 'Bespoke Stonework',
            'material' => 'Solid Roman Travertine',
            'origin' => 'Hand-carved shallow fluting, porous matte finish',
        ],
        [
            'name' => 'The Amber Glass Decanter',
            'category' => 'Glassware & Vessels',
            'material' => 'Hand-Blown Smoky Amber Glass',
            'origin' => 'Subtle light refraction, tactile weighted base',
        ],
        [
            'name' => 'The Forged Bronze Candlestick',
            'category' => 'Architectural Metal',
            'material' => 'Hand-Forged Blackened Bronze',
            'origin' => 'Minimal geometric silhouette, living patina',
        ],
        [
            'name' => 'The Sculptural Arc Sconce',
            'category' => 'Lighting',
            'material' => 'Hand-turned Aged Brass',
            'origin' => 'Dimmable ambient warm glow, studio commission',
        ],
    ];
@endphp

<section class="curated-objects-section" aria-labelledby="curated-objects-title">
    <div class="curated-objects-header">
        <div>
            <p class="eyebrow">The GREI Edit / Objects in this space</p>
            <h2 id="curated-objects-title">Curated pieces.<br>Available to <span>source.</span></h2>
        </div>
        <p class="detail-caption">Every object in a GREI space can be commissioned or acquired through our design studio.</p>
    </div>

    <!-- Editorial Centerpiece Artifacts Trio -->
    <div class="curated-artifacts-stage">
        <div class="artifacts-visual">
            <img src="{{ asset('assets/curated-artifacts.webp') }}" 
                 alt="Trio of bespoke handcrafted artifacts: fluted travertine dish, amber glass and forged bronze" 
                 width="800" 
                 height="600" 
                 class="curated-artifacts-image" 
                 loading="lazy">
        </div>
        <div class="artifacts-aside">
            <div class="artifacts-badge">
                <x-grei.kinetic-meridian size="42" label="Studio Collectible Emblem" />
                <span class="eyebrow">Studio Collectibles · Edition 01</span>
            </div>
            <h3>Material Authenticity in Every Object</h3>
            <p>From the porous weight of hand-carved stone to the warm refraction of smoky blown glass, our spaces are completed by the pieces that live within them.</p>
            <button type="button" 
                    class="solid-button" 
                    data-enquiry="design" 
                    data-enquiry-message="I would like to enquire about sourcing the Studio Artifacts Edition (Fluted Travertine, Amber Glass & Bronze) seen in {{ $spaceTitle }}.">
                <span>Acquire or commission pieces</span>
                <x-grei.icon name="arrow-up-right" />
            </button>
        </div>
    </div>

    <div class="curated-objects-grid">
        @foreach($objects as $item)
            <article class="object-card">
                <div>
                    <div class="object-meta">
                        <span>{{ $item['category'] }}</span>
                        <span>{{ $item['material'] }}</span>
                    </div>
                    <h3>{{ $item['name'] }}</h3>
                    <p>{{ $item['origin'] }}</p>
                </div>
                <button type="button" 
                        class="object-source-btn" 
                        data-enquiry="design" 
                        data-enquiry-message="I am interested in commissioning or sourcing the {{ $item['name'] }} ({{ $item['category'] }}) seen in {{ $spaceTitle }}.">
                    <span>Enquire to source</span>
                    <x-grei.icon name="arrow-up-right" />
                </button>
            </article>
        @endforeach
    </div>
</section>

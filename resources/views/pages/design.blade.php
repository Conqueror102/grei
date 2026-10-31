<x-grei.layout title="Interior design — GREI">
    <x-grei.header />
    <main id="main-content" class="studio-page">
        <section class="studio-hero page-shell">
            <p class="eyebrow">The GREI design studio</p>
            <div>
                <h1>Your space.<br><span>Your signature.</span></h1>
                <img class="page-cutout studio-chair" src="{{ asset('assets/design-assemblage.webp') }}" width="1536" height="1024" alt="A rust lounge chair with floating stone, metal and walnut material samples">
            </div>
            <p>The quiet details. The unexpected pairings.<br>Interiors shaped around how you live and work.</p>
            <a class="solid-button" href="{{ route('design.consultation') }}">Tell us what you’re imagining<x-grei.icon /></a>
        </section>

        <section class="studio-services page-shell">
            <div class="studio-services-heading">
                <p class="eyebrow">A feeling. Made tangible.</p>
                <h2>From the big idea<br>to the <span>smallest detail.</span></h2>
            </div>
            <div>
                @foreach(config('grei.design_services') as $key=>$item)
                    <a class="studio-service" href="{{ route('design.service',$key) }}">
                        <span class="eyebrow">0{{ $loop->iteration }}</span>
                        <div>
                            <h3>{{ $item['title'] }}</h3>
                            <p>{{ $item['intro'] }}</p>
                        </div>
                        <x-grei.icon />
                    </a>
                @endforeach
            </div>
        </section>

        <section class="design-journey-section page-shell" aria-labelledby="journey-title">
            <p class="eyebrow">The Collaborative Journey</p>
            <h2 id="journey-title">From initial conversation<br>to <span>turnkey reveal.</span></h2>
            <div class="journey-timeline">
                <div class="journey-step is-active">
                    <span class="step-number">01 / DISCOVERY</span>
                    <h3>The Listening Phase</h3>
                    <p>We explore your lifestyle rhythms, rituals, and aesthetic desires to build an intimate spatial brief.</p>
                </div>
                <div class="journey-step">
                    <span class="step-number">02 / DIRECTION</span>
                    <h3>Spatial & Material Direction</h3>
                    <p>Curated architectural palettes, tactile finish boards, lighting schematics, and 3D spatial studies.</p>
                </div>
                <div class="journey-step">
                    <span class="step-number">03 / FABRICATION</span>
                    <h3>Bespoke Sourcing</h3>
                    <p>Custom artisan millwork, stone fabrication, and international acquisition of rare vintage and contemporary pieces.</p>
                </div>
                <div class="journey-step">
                    <span class="step-number">04 / REVEAL</span>
                    <h3>Turnkey Styling</h3>
                    <p>White-glove installation, acoustic calibration, botanical curation, and personal handover of your finished home.</p>
                </div>
            </div>
        </section>

        <x-grei.spatial-curator />

        <section class="studio-work page-shell">
            <div class="section-heading">
                <div>
                    <p class="eyebrow">A few perspectives.</p>
                    <h2>Design with<br><span>feeling.</span></h2>
                </div>
                <a class="text-link" href="{{ route('projects.index') }}">Explore the portfolio<x-grei.icon /><span class="link-line"></span></a>
            </div>
            <div class="portfolio-grid">
                @forelse($projects as $project)
                    <x-grei.project-card :project="$project" />
                @empty
                    <div class="catalogue-empty">
                        <h3>A new space starts with a conversation.</h3>
                        <a class="solid-button" href="{{ route('design.consultation') }}">Share your design brief<x-grei.icon /></a>
                    </div>
                @endforelse
            </div>
        </section>

        <x-grei.design-process />

        <section class="studio-closing page-shell">
            <p class="eyebrow">Good design begins with listening.</p>
            <h2>Let’s start<br>with <span>you.</span></h2>
            <a class="solid-button" href="{{ route('design.consultation') }}">Book a design conversation<x-grei.icon /></a>
        </section>
    </main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

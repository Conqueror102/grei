<x-grei.layout title="The GREI point of view — About us">
    <x-grei.header />
    <main id="main-content" class="about-page">
        <section class="about-page-hero page-shell">
            <p class="eyebrow">Property. Stays. Interiors. One point of view.</p>
            <h1>Life happens<br>in <span>spaces.</span></h1>
            <div>
                <p>Where you wake up. Where you return to.<br>Where your next chapter takes shape.</p>
                <img class="page-cutout" src="{{ asset('assets/house-cutaway.webp') }}" width="1536" height="1024" alt="Cutaway architectural model of a considered home">
            </div>
        </section>

        <section class="about-manifesto page-shell">
            <p class="eyebrow">The world of GREI</p>
            <h2>We bring property,<br>stays and design<br>into the same <span>conversation.</span></h2>
            <div>
                <p>{{ $brand->get('about_text','GREI connects the places we choose with the way we want to live. From finding your next address to a furnished stay or an interior shaped around you, our starting point is the same: what makes a space feel right for you.') }}</p>
                <p>Different spaces.<br>One considered point of view.</p>
            </div>
        </section>

        <section class="about-standards page-shell">
            <p class="eyebrow">The Architectural Standard</p>
            <h2>Five tenets of every<br>GREI <span>space.</span></h2>
            <div class="grei-standards-grid">
                <article class="standard-card">
                    <span class="standard-number">01 / ORIENTATION</span>
                    <h3>Natural Light First</h3>
                    <p>Spaces oriented around the sun's trajectory. Generous dawn light for kitchen and gathering areas; softened evening shadows for rest.</p>
                </article>
                <article class="standard-card">
                    <span class="standard-number">02 / PROVENANCE</span>
                    <h3>Material Honesty</h3>
                    <p>Natural travertine, solid French oak, hand-trowelled plaster, and patinated unlacquered brass that ages gracefully over decades.</p>
                </article>
                <article class="standard-card">
                    <span class="standard-number">03 / SANCTUARY</span>
                    <h3>Acoustic Calm</h3>
                    <p>Thoughtful spatial isolation and sound-absorbing textiles that mute the city's pulse into a restorative sanctuary.</p>
                </article>
                <article class="standard-card">
                    <span class="standard-number">04 / FLOW</span>
                    <h3>Spatial Proportion</h3>
                    <p>Layouts shaped around human ergonomics, unencumbered circulation, and unhurried ease rather than dense square footage.</p>
                </article>
                <article class="standard-card">
                    <span class="standard-number">05 / REFINEMENT</span>
                    <h3>Turnkey Serenity</h3>
                    <p>From day one, whether stepping into an acquired residence, checking into a stay, or completing a custom interior renovation.</p>
                </article>
            </div>
        </section>

        <section class="about-perspectives">
            <div class="page-shell">
                <p class="eyebrow">What we keep coming back to.</p>
                @foreach([
                    ['People, first.','The way you live, work and spend your time is where every spatial conversation begins.'],
                    ['The details matter.','Light, materials, proportion and the little decisions shape the feeling of the everyday.'],
                    ['A point of view.','Spaces can be practical, personal and full of character at the exact same time.']
                ] as $point)
                    <div>
                        <span class="eyebrow">0{{ $loop->iteration }}</span>
                        <h3>{{ $point[0] }}</h3>
                        <p>{{ $point[1] }}</p>
                    </div>
                @endforeach
            </div>
        </section>

        <section class="about-three-paths page-shell">
            <p class="eyebrow">Where will we begin?</p>
            <a href="{{ route('properties.index') }}">
                <span>Find your place.</span>
                <x-grei.icon />
            </a>
            <a href="{{ route('stays.index') }}">
                <span>Stay a little.</span>
                <x-grei.icon />
            </a>
            <a href="{{ route('design') }}">
                <span>Make it yours.</span>
                <x-grei.icon />
            </a>
        </section>
    </main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

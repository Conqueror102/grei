<section id="property" class="collection-section chapter" aria-labelledby="collection-title">
    <div class="collection-heading section-heading">
        <div>
            <p class="eyebrow section-kicker">02 / Find a property</p>
            <h2 id="collection-title">Some places<br>just feel right.</h2>
        </div>
        <div class="section-aside">
            <p>Room for a new chapter.<br>Space for a different future.</p>
            <p class="collection-note">An illustrative collection of possibilities. Speak with GREI for current listings and availability.</p>
        </div>
    </div>
    <div class="collection-toolbar">
        <div class="collection-filters" role="group" aria-label="Filter the property collection">
            <button type="button" data-property-filter="all" aria-pressed="true">All spaces<span>03</span></button>
            <button type="button" data-property-filter="sale" aria-pressed="false">For sale</button>
            <button type="button" data-property-filter="rent" aria-pressed="false">For rent</button>
            <button type="button" data-property-filter="investment" aria-pressed="false">Investment</button>
        </div>
        <span class="eyebrow collection-count" aria-live="polite">03 possibilities</span>
    </div>
    <div class="collection-stage">
        <div class="collection-feature">
            <button class="collection-image-button" type="button" data-open-space="courtyard" aria-label="Explore The Courtyard House"><img class="collection-photo" src="{{ asset('assets/courtyard-exterior.webp') }}" width="1536" height="1024" alt="Contemporary courtyard residence framed by tropical planting" loading="lazy"><span class="image-explore"><span>Explore this space</span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></span></button>
            <div class="collection-caption"><span class="eyebrow collection-kind">Residential / Collection study</span><span class="collection-current">01 — 03</span>
            </div>
        </div>
        <div class="collection-index" aria-label="Property collection">
            <button class="collection-entry is-selected" type="button" data-property="courtyard" data-categories="sale investment" aria-pressed="true"><span class="entry-number">01</span><span class="entry-copy"><span class="entry-type">A little more room to grow</span><strong>The Courtyard <br>House</strong><span class="entry-spec">Detached residence · Garden living</span></span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
            <button class="collection-entry" type="button" data-property="apartment" data-categories="rent" aria-pressed="false"><span class="entry-number">02</span><span class="entry-copy"><span class="entry-type">A new perspective on the everyday</span><strong>The City <br>Apartment</strong><span class="entry-spec">Furnished apartment · Urban living</span></span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
            <button class="collection-entry" type="button" data-property="retreat" data-categories="sale investment" aria-pressed="false"><span class="entry-number">03</span><span class="entry-copy"><span class="entry-type">Space to see things differently</span><strong>The Coastal <br>Retreat</strong><span class="entry-spec">Private residence · Open-air living</span></span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
            <div style="display:flex; align-items:center; justify-content:space-between; flex-wrap:wrap; gap:16px; margin-top:24px;">
                <button class="collection-enquiry text-link" type="button" data-enquiry="property">Have somewhere in mind? Let’s find it.<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span><span class="link-line" aria-hidden="true"></span></button>
                <a class="solid-button" href="{{ route('properties.index') }}"><span>Browse all properties</span><x-grei.icon /></a>
            </div>
        </div>
    </div>
</section>

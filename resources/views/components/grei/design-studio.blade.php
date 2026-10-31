<section id="design" class="design-section chapter" aria-labelledby="design-title">
    <div class="design-heading">
        <p class="eyebrow section-kicker">04 / Design a space</p>
        <div class="design-title-row">
            <h2 id="design-title">Good design.<br><span>A feeling.</span></h2>
            <figure class="design-object"><img src="{{ asset('assets/design-assemblage.webp') }}" width="1536" height="1024" alt="Sculptural rust chair surrounded by floating stone, metal and walnut samples" loading="lazy">
            </figure>
            <div class="design-intro">
                <p>The quiet details. The unexpected pairings. The way a room makes you feel.</p>
                <p>We bring your perspective into the spaces you live and work in.</p>
                <button class="text-link" type="button" data-enquiry="design">Tell us what you’re imagining<span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span><span class="link-line" aria-hidden="true"></span></button>
            </div>
        </div>
    </div>
    <div class="design-gallery">
        <article class="design-project design-project-primary">
            <button class="project-image" type="button" data-open-space="geometry" aria-label="Explore Soft Geometry residential design concept"><img src="{{ asset('assets/soft-geometry.webp') }}" width="1536" height="1152" alt="Sculptural plaster staircase, walnut panels and a rust lounge chair" loading="lazy"><span class="project-roundel"><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></span></button>
            <div class="project-caption"><span class="project-caption-number">01</span>
                <div><span class="eyebrow">Residential / Concept study</span>
                    <h3>Soft geometry.</h3>
                </div>
                <span class="project-caption-note">Warmth in every line.</span>
            </div>
        </article>
        <article class="design-project design-project-secondary">
            <div class="design-margin-note"><span class="icon" data-icon="asterisk" aria-hidden="true"></span>
                <p>Spaces with character.<br>Designed around people.</p>
            </div>
            <button class="project-image" type="button" data-open-space="social" aria-label="Explore The Social Room commercial design concept"><img src="{{ asset('assets/the-social-room.webp') }}" width="1536" height="1152" alt="Intimate lounge with an oxblood banquette, walnut furniture and expressive blue art" loading="lazy"><span class="project-roundel"><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></span></button>
            <div class="project-caption"><span class="project-caption-number">02</span>
                <div><span class="eyebrow">Commercial / Concept study</span>
                    <h3>The social room.</h3>
                </div>
            </div>
        </article>
    </div>
    <div class="design-services">
        <span class="eyebrow">Your vision. Our starting point.</span>
        <div>
            <span>Residential interiors</span>
            <span>Commercial spaces</span>
            <span>Styling & finishing</span>
        </div>
        <p>Concept imagery illustrates our design direction.<br>Let’s create a space that tells your story.</p>
        <div style="margin-top:20px; display:flex; gap:16px; flex-wrap:wrap; justify-content:center;">
            <a class="solid-button" href="{{ route('projects.index') }}"><span>Explore portfolio</span><x-grei.icon /></a>
            <a class="outline-button" href="{{ route('design') }}"><span>Studio services</span><x-grei.icon /></a>
        </div>
    </div>
</section>

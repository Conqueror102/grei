@props(['location' => 'Garden District', 'address' => null])

<section class="neighborhood-guide-section" aria-labelledby="neighborhood-guide-title">
    <div class="neighborhood-header">
        <p class="eyebrow">A Sense of Place / {{ $location }}</p>
        <h2 id="neighborhood-guide-title">The rhythm of<br>the <span>neighbourhood.</span></h2>
    </div>
    <div class="neighborhood-grid">
        <article class="neighborhood-card">
            <x-grei.icon name="coffee" />
            <div>
                <h3>The Morning Ritual</h3>
                <p>Artisan specialty micro-roasters, slow fermented sourdough, and quiet morning corners just steps from your entrance.</p>
            </div>
        </article>
        <article class="neighborhood-card">
            <x-grei.icon name="compass" />
            <div>
                <h3>Art & Spatial Culture</h3>
                <p>Independent contemporary design ateliers, sculpture courtyards, and quiet gallery spaces that celebrate craftsmanship.</p>
            </div>
        </article>
        <article class="neighborhood-card">
            <x-grei.icon name="tree" />
            <div>
                <h3>Green Seclusion & Strolls</h3>
                <p>Tree-lined avenues, secluded public botanical gardens, and peaceful sunset paths insulated from urban hustle.</p>
            </div>
        </article>
    </div>
</section>
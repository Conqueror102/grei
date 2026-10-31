<section id="spatial-curator" class="curator-section page-shell" aria-labelledby="curator-title">
    <div class="curator-header section-heading">
        <div>
            <p class="eyebrow section-kicker">Interactive Studio / Spatial Blueprint</p>
            <h2 id="curator-title">Curate your<br>own <span>atmosphere.</span></h2>
        </div>
        <div class="section-aside">
            <p>Every interior begins with a dialogue between materials, light, and tactile warmth. Select your archetype to generate a tailored spatial signature.</p>
        </div>
    </div>

    <div class="curator-workbench" id="curator-workbench">
        <!-- Living 3D Spatial Canvas -->
        <div class="curator-stage" id="curator-stage" data-archetype="monolith">
            <div class="curator-canvas-backdrop" id="curator-backdrop"></div>
            
            <!-- Layer 1: Sculptural Artwork Trio -->
            <div class="curator-layer curator-layer-artifacts" id="curator-artifacts-layer">
                <img src="{{ asset('assets/curated-artifacts.webp') }}" 
                     alt="Curated handcrafted artifacts: fluted travertine dish, amber glass and forged bronze" 
                     width="700" 
                     height="525" 
                     class="curator-img-artifacts">
            </div>

            <!-- Layer 2: Centerpiece Monolith -->
            <div class="curator-layer curator-layer-monolith" id="curator-monolith-layer">
                <img src="{{ asset('assets/sensory-monolith.webp') }}" 
                     alt="Travertine monolith sculpture with brass orbit" 
                     width="500" 
                     height="500" 
                     class="curator-img-monolith">
            </div>

            <!-- Kinetic Blueprint Stamp Overlay -->
            <div class="curator-blueprint-stamp">
                <x-grei.kinetic-meridian size="48" label="Studio Certification Seal" />
                <div class="blueprint-code-wrap">
                    <span class="eyebrow">Atmospheric Code</span>
                    <strong id="curator-blueprint-code">GREI-MONO-48</strong>
                </div>
            </div>
        </div>

        <!-- Controls: Archetype & Parameters -->
        <div class="curator-controls">
            <p class="eyebrow">01 / Choose your spatial philosophy</p>
            <div class="archetype-selector" role="radiogroup" aria-label="Select design archetype">
                <button type="button" class="archetype-btn is-active" data-archetype="monolith" aria-checked="true" role="radio">
                    <div class="archetype-dot swatch-travertine"></div>
                    <div>
                        <strong>The Raw Monolith</strong>
                        <span>Honed Roman Travertine · Living Brass · Calm Stone</span>
                    </div>
                </button>
                <button type="button" class="archetype-btn" data-archetype="sanctuary" aria-checked="false" role="radio">
                    <div class="archetype-dot swatch-oak"></div>
                    <div>
                        <strong>The Tactile Sanctuary</strong>
                        <span>Smoked French Oak · Amber Glass · Belgian Linen</span>
                    </div>
                </button>
                <button type="button" class="archetype-btn" data-archetype="salon" aria-checked="false" role="radio">
                    <div class="archetype-dot swatch-velvet"></div>
                    <div>
                        <strong>The Nightfall Salon</strong>
                        <span>Blackened Bronze · Oxblood Velvet · Matte Plaster</span>
                    </div>
                </button>
            </div>

            <p class="eyebrow" style="margin-top:28px;">02 / Space Scale & Rhythm</p>
            <div class="curator-scales" role="group" aria-label="Select scale of residence">
                <button type="button" class="scale-btn is-selected" data-scale="Private Residence">Private Residence</button>
                <button type="button" class="scale-btn" data-scale="Urban Penthouse">Urban Penthouse</button>
                <button type="button" class="scale-btn" data-scale="Boutique Hospitality">Hospitality Atelier</button>
            </div>

            <!-- Direct Studio WhatsApp Handoff with Custom Blueprint Data -->
            <div class="curator-handoff">
                <div class="curator-summary">
                    <p id="curator-summary-text">"A monolithic architectural composition centered on natural stone mass, raw brass orbit reflections, and acoustic quiet."</p>
                </div>
                <a href="#" id="curator-whatsapp-btn" class="solid-button" target="_blank" rel="noopener">
                    <span>Commission this Spatial Direction</span>
                    <x-grei.icon name="arrow-up-right" />
                </a>
            </div>
        </div>
    </div>
</section>
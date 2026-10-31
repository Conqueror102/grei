<section id="solar-dial" class="solar-dial-section chapter" aria-labelledby="solar-title">
    <div class="solar-dial-inner page-shell">
        <div class="solar-heading section-heading">
            <div>
                <p class="eyebrow section-kicker">01.5 / The Architecture of Light</p>
                <h2 id="solar-title">Spaces sculpted<br>by the <span>sun.</span></h2>
            </div>
            <div class="section-aside">
                <p>A home is never static.<br>From dawn's pale stillness to the amber warmth of dusk, light defines how a space breathes.</p>
                <div class="solar-meridian-badge">
                    <x-grei.kinetic-meridian size="54" label="Solar tracking meridian" />
                    <span>Diurnal Study · Real-time simulation</span>
                </div>
            </div>
        </div>

        <div class="solar-stage" id="solar-stage" data-solar-phase="golden">
            <!-- Celestial Orbit Track Overlay -->
            <div class="solar-celestial-canvas" aria-hidden="true">
                <svg viewBox="0 0 800 400" class="solar-orbit-svg">
                    <path d="M 50,380 Q 400,-50 750,380" class="solar-orbit-path" />
                    <!-- Dynamic Sun Orb positioned along arc -->
                    <circle id="solar-sun-orb" cx="620" cy="180" r="14" class="solar-sun-orb" />
                    <circle id="solar-sun-pulse" cx="620" cy="180" r="28" class="solar-sun-pulse" />
                </svg>
            </div>

            <!-- Central Architectural Sculpture: The Monolith Cutout -->
            <div class="solar-sculpture-container">
                <img src="{{ asset('assets/sensory-monolith.webp') }}" 
                     alt="Travertine monolith sculpture with brass orbital ring and wild olive branch" 
                     width="900" 
                     height="900" 
                     class="solar-sculpture-img" 
                     id="solar-sculpture">
                <div class="solar-ambient-glow" id="solar-ambient-glow"></div>
            </div>

            <!-- Live Atmospheric Metrics Telemetry -->
            <div class="solar-telemetry" aria-live="polite">
                <div class="telemetry-block">
                    <span class="eyebrow">Colour Temp</span>
                    <strong id="telemetry-kelvin">2700 K</strong>
                </div>
                <div class="telemetry-block">
                    <span class="eyebrow">Solar Altitude</span>
                    <strong id="telemetry-altitude">18° SW</strong>
                </div>
                <div class="telemetry-block">
                    <span class="eyebrow">Acoustic Mood</span>
                    <strong id="telemetry-acoustic">Stillness · 22 dB</strong>
                </div>
                <div class="telemetry-description">
                    <p id="telemetry-poetry">"Low-angled golden light floods across raw travertine edges, casting long dramatic amber shadows."</p>
                </div>
            </div>
        </div>

        <!-- Interactive Time Controller / Brass Dial -->
        <div class="solar-controller" role="group" aria-label="Select time of day">
            <button type="button" class="solar-time-btn" data-phase="dawn" aria-pressed="false">
                <span class="time-hour">07:00</span>
                <span class="time-label">Dawn Mist</span>
                <span class="time-sub">Cool silence · First coffee</span>
            </button>
            <button type="button" class="solar-time-btn" data-phase="zenith" aria-pressed="false">
                <span class="time-hour">12:30</span>
                <span class="time-label">High Noon</span>
                <span class="time-sub">Pure clarity · Razor shadows</span>
            </button>
            <button type="button" class="solar-time-btn is-active" data-phase="golden" aria-pressed="true">
                <span class="time-hour">17:45</span>
                <span class="time-label">Golden Hour</span>
                <span class="time-sub">Warm honey · Low glow</span>
            </button>
            <button type="button" class="solar-time-btn" data-phase="twilight" aria-pressed="false">
                <span class="time-hour">21:30</span>
                <span class="time-label">Nightfall</span>
                <span class="time-sub">Candlelight · Acoustic calm</span>
            </button>
        </div>
    </div>
</section>
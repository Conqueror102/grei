<section id="stay" class="stay-section chapter" aria-labelledby="stay-title">
    <div class="stay-inner">
        <div class="stay-heading section-heading"><img class="stay-keys" src="{{ asset('assets/stay-keys.webp') }}" width="1312" height="1199" alt="" loading="lazy">
            <div>
                <p class="eyebrow section-kicker">03 / Book a stay</p>
                <h2 id="stay-title">Less rushing.<br>More living.</h2>
            </div>
            <div class="section-aside"><span class="stay-doodle" aria-hidden="true">↗</span>
                <p>Check in. Breathe out.<br>Thoughtfully furnished spaces,<br>for however long you call them home.</p>
            </div>
        </div>
        <div class="stay-canvas"><img class="stay-landscape" src="{{ asset('assets/courtyard-residence.webp') }}" width="1374" height="1145" alt="Sunlit living space opening onto a private pool and tropical garden" loading="lazy">
            <div class="stay-image-shade">
            </div>
            <div class="stay-canvas-copy"><span class="eyebrow">Make yourself at home</span>
                <p>Your own pace.<br>Your own place.</p>
            </div>
            <figure class="stay-inset"><img src="{{ asset('assets/slow-morning.webp') }}" width="1536" height="1024" alt="Soft morning light falling across a thoughtfully furnished bedroom" loading="lazy">
                <figcaption><span>Slow mornings, included.</span><span class="icon" data-icon="sun" aria-hidden="true"></span></figcaption>
            </figure>
            <button class="stay-view-button" type="button" data-open-space="stay"><span class="icon" data-icon="squares-four" aria-hidden="true"></span>Take a closer look</button>
        </div>
        <form class="stay-planner" aria-label="Plan your stay">
            <label><span class="eyebrow">Check in</span><input type="date" name="checkin" aria-label="Check-in date" required></label>
            <label><span class="eyebrow">Check out</span><input type="date" name="checkout" aria-label="Check-out date" required></label>
            <label class="stay-guests"><span class="eyebrow">Your company</span><select name="guests" aria-label="Number of guests"><option value="1">1 guest</option><option value="2" selected>2 guests</option><option value="3">3 guests</option><option value="4">4 guests</option><option value="5">5 guests</option><option value="6+">6+ guests</option></select></label>
            <button type="submit"><span>Let’s plan your stay</span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
        </form>
        <div class="stay-bottom">
            <div class="stay-amenities" aria-label="The essentials"><span><span class="icon" data-icon="wifi-high" aria-hidden="true"></span>Stay connected</span><span><span class="icon" data-icon="cooking-pot" aria-hidden="true"></span>Feel at home</span><span><span class="icon" data-icon="bed" aria-hidden="true"></span>Rest easy</span>
            </div>
            <div style="display:flex; flex-direction:column; align-items:flex-end; gap:12px;">
                <p style="margin:0;">Share your dates on WhatsApp.<br>GREI confirms the apartment, amenities and availability.</p>
                <a class="solid-button" href="{{ route('stays.index') }}"><span>View all furnished stays</span><x-grei.icon /></a>
            </div>
        </div>
    </div>
</section>

<dialog id="space-dialog" class="space-dialog" aria-labelledby="space-title" data-lenis-prevent>
    <button class="icon-button space-close" type="button" aria-label="Close space details"><span class="icon" data-icon="x" aria-hidden="true"></span></button>
    <div class="space-dialog-grid">
        <div class="space-gallery"><img class="space-main-image" src="{{ asset('assets/courtyard-exterior.webp') }}" width="1536" height="1024" alt="">
            <div class="space-thumbnails" aria-label="Gallery views">
            </div>
        </div>
        <div class="space-information">
            <p class="eyebrow space-category"></p>
            <h2 id="space-title"></h2>
            <p class="space-description"></p>
            <h3 class="eyebrow space-feature-title">The point of view</h3>
            <ul class="space-features"></ul>
            <button class="space-enquire" type="button"><span>Start a conversation</span><span class="icon" data-icon="arrow-up-right" aria-hidden="true"></span></button>
            <p class="space-disclaimer">Concept imagery. Current availability, pricing and project scope are confirmed directly with GREI.</p>
        </div>
    </div>
</dialog>

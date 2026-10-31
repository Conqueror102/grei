<div id="shortlist-floating-pill" class="shortlist-floating-pill" style="display:none;" role="button" aria-label="View shortlisted spaces">
    <x-grei.icon name="heart" />
    <span>Shortlisted spaces</span>
    <span class="shortlist-count" id="shortlist-count-badge">0</span>
</div>

<dialog id="shortlist-drawer" class="shortlist-drawer" aria-labelledby="shortlist-drawer-title">
    <div class="shortlist-drawer-content">
        <div class="shortlist-drawer-header">
            <div>
                <p class="eyebrow">Your Selection</p>
                <h2 id="shortlist-drawer-title">Shortlisted Spaces</h2>
            </div>
            <button type="button" class="icon-button" id="shortlist-close-btn" aria-label="Close shortlist">
                <x-grei.icon name="x" />
            </button>
        </div>
        <div id="shortlist-items-container" class="shortlist-items-list">
            <!-- Populated via shortlist.js -->
        </div>
        <div class="shortlist-drawer-actions">
            <button type="button" class="text-link" id="shortlist-clear-btn">
                <span>Clear list</span>
                <span class="link-line"></span>
            </button>
            <a href="#" id="shortlist-share-whatsapp" class="solid-button" target="_blank" rel="noopener">
                <span>Share shortlist on WhatsApp</span>
                <x-grei.icon name="share-network" />
            </a>
        </div>
    </div>
</dialog>
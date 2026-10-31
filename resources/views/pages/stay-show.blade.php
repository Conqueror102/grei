<x-grei.layout :title="$listing->title.' — GREI Stays'" :description="$listing->summary">
    <x-grei.header />
    <main id="main-content" class="space-page stay-detail">
        <div class="page-shell">
            <nav class="breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">GREI</a>
                <span>/</span>
                <a href="{{ route('stays.index') }}">Stays</a>
                <span>/</span>
                <span>{{ $listing->title }}</span>
            </nav>
            <div class="detail-heading">
                <div>
                    <p class="eyebrow">{{ $listing->location }} / {{ $listing->guest_capacity }} guests</p>
                    <h1>{{ $listing->title }}</h1>
                </div>
                <span class="stay-detail-mark"><x-grei.icon name="sun" /></span>
            </div>
            @if($listing->is_demo)
                <p class="preview-notice">A furnished-stay concept. The apartment, district, amenities and rate are illustrative. GREI confirms actual options before a reservation.</p>
            @endif
            <x-grei.space-gallery :space="$listing" />
            <div class="detail-body-grid">
                <div>
                    <x-grei.listing-overview :listing="$listing" />
                    <x-grei.stay-rituals />
                    <x-grei.material-palette :space="$listing" />
                    <x-grei.neighborhood-guide :location="$listing->location" />
                    <x-grei.curated-objects :space-title="$listing->title" />
                    <section class="stay-how-to" id="enquire">
                        <p class="eyebrow">Your stay, in three little steps.</p>
                        <ol>
                            <li><span>01</span><p>Choose your dates and check the apartment’s calendar.</p></li>
                            <li><span>02</span><p>Continue directly to GREI on WhatsApp with your apartment, dates and guests.</p></li>
                            <li><span>03</span><p>Confirm the final details with the team, then make yourself at home.</p></li>
                        </ol>
                    </section>
                </div>
                <aside class="detail-booking">
                    <livewire:stay-booking :listing="$listing" />
                </aside>
            </div>
        </div>
        <section class="page-conversation page-shell">
            <p class="eyebrow">Another way to get away.</p>
            <h2>A different space.<br>The same considered <span>feeling.</span></h2>
            <a class="solid-button" href="{{ route('stays.index') }}">Explore more stays<x-grei.icon /></a>
        </section>
        <x-grei.mobile-sticky-bar :listing="$listing" />
    </main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

<x-grei.layout :title="$listing->title.' — GREI Properties'" :description="$listing->summary">
    <x-grei.header />
    <main id="main-content" class="space-page property-detail">
        <div class="page-shell">
            <nav class="breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('home') }}">GREI</a>
                <span>/</span>
                <a href="{{ route('properties.index') }}">Properties</a>
                <span>/</span>
                <span>{{ $listing->title }}</span>
            </nav>
            <div class="detail-heading">
                <div>
                    <p class="eyebrow">{{ $listing->location }} / {{ config('grei.categories.'.$listing->category) }}</p>
                    <h1>{{ $listing->title }}</h1>
                </div>
                <div class="detail-price">
                    {{ $listing->priceLabel() }}
                    @if($listing->price_period)
                        <span>per {{ $listing->price_period }}</span>
                    @endif
                </div>
            </div>
            @if($listing->is_demo)
                <p class="preview-notice">Concept listing. Photography, district, specifications and price are illustrative. Ask GREI for current verified properties.</p>
            @endif
            <x-grei.space-gallery :space="$listing" />
            <div class="detail-body-grid">
                <div>
                    <x-grei.listing-overview :listing="$listing" />
                    <x-grei.material-palette :space="$listing" />
                    <x-grei.neighborhood-guide :location="$listing->location" />
                    <x-grei.curated-objects :space-title="$listing->title" />
                </div>
                <aside id="enquire" class="detail-enquiry">
                    <p class="eyebrow">Your next chapter?</p>
                    <h2>Let’s open<br>the door.</h2>
                    <p>Ask about the property, arrange a viewing, or tell us what you’re looking for.</p>
                    <livewire:enquiry-form service="property" :listing-id="$listing->id" :message="'I’m interested in '.$listing->title.'. Please share more details and viewing options.'" />
                </aside>
            </div>
        </div>
        <section class="page-conversation page-shell">
            <p class="eyebrow">Keep exploring.</p>
            <h2>Another place.<br>Another <span>possibility.</span></h2>
            <a class="solid-button" href="{{ route('properties.index') }}">Back to properties<x-grei.icon /></a>
        </section>
        <x-grei.mobile-sticky-bar :listing="$listing" />
    </main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

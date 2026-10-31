@props(['listing'])
<article class="listing-card" wire:key="listing-{{ $listing->id }}">
    <a class="listing-card-image" href="{{ route($listing->kind === 'stay' ? 'stays.show' : 'properties.show', $listing) }}">
        <img src="{{ $listing->coverUrl() }}" alt="{{ $listing->title }}" width="900" height="700" loading="lazy">
        <span class="listing-card-category">{{ $listing->kind === 'stay' ? 'Furnished stay' : config('grei.categories.'.$listing->category) }}</span>
        <span class="listing-card-arrow"><x-grei.icon /></span>
        <button type="button" 
                class="listing-save-btn" 
                data-space-id="{{ $listing->id }}"
                data-space-title="{{ $listing->title }}"
                data-space-slug="{{ $listing->slug }}"
                data-space-kind="{{ $listing->kind }}"
                data-space-price="{{ $listing->priceLabel() }}"
                data-space-location="{{ $listing->location }}"
                data-space-cover="{{ $listing->coverUrl() }}"
                data-space-url="{{ route($listing->kind === 'stay' ? 'stays.show' : 'properties.show', $listing) }}"
                aria-label="Save to shortlist">
            <x-grei.icon name="heart" />
        </button>
    </a>
    <div class="listing-card-meta"><span>{{ $listing->location }}</span>@if($listing->is_demo)<span>Concept listing</span>@endif</div>
    <h2><a href="{{ route($listing->kind === 'stay' ? 'stays.show' : 'properties.show', $listing) }}">{{ $listing->title }}</a></h2>
    <p class="listing-card-specs"><span>{{ $listing->bedrooms }} {{ Str::plural('bedroom', $listing->bedrooms) }}</span><span>{{ $listing->bathrooms }} {{ Str::plural('bathroom', $listing->bathrooms) }}</span>@if($listing->kind === 'stay')<span>{{ $listing->guest_capacity }} guests</span>@endif</p>
    <div class="listing-card-price"><span>{{ $listing->priceLabel() }}@if($listing->price_minor !== null && $listing->price_period)<small> / {{ $listing->price_period }}</small>@endif</span>@if($listing->is_demo)<small>Illustrative rate</small>@endif</div>
</article>

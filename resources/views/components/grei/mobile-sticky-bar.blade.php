@props(['listing'])

<div class="mobile-sticky-action" aria-label="Quick action">
    <div class="mobile-sticky-inner">
        <div class="mobile-sticky-price">
            <strong>{{ $listing->priceLabel() }}</strong>
            <span>{{ $listing->kind === 'stay' ? 'per night · '.$listing->guest_capacity.' guests' : ($listing->price_period ? 'per '.$listing->price_period : 'Guide price') }}</span>
        </div>
        @if($listing->kind === 'stay')
            <a href="#enquire" class="solid-button">
                <span>Book stay</span>
                <x-grei.icon name="arrow-up-right" />
            </a>
        @else
            <a href="#enquire" class="solid-button">
                <span>Enquire now</span>
                <x-grei.icon name="arrow-up-right" />
            </a>
        @endif
    </div>
</div>
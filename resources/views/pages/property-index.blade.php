<?php

use App\Models\Listing;
use App\Services\ListingSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::public'), Title('Find a property — GREI')] class extends Component {
    use WithPagination;
    #[Url] public string $location = '';
    #[Url] public string $property_type = '';
    #[Url] public string $category = '';
    #[Url] public string $currency = 'NGN';
    #[Url] public string $min_price = '';
    #[Url] public string $max_price = '';
    #[Url] public string $bedrooms = '';
    #[Url] public string $sort = 'featured';

    protected function rules(): array {
        return ['location'=>'nullable|string|max:100','property_type'=>'nullable|in:'.implode(',',array_keys(config('grei.property_types'))),'category'=>'nullable|in:sale,rent,investment','currency'=>'required|in:NGN,USD,GBP,EUR','min_price'=>'nullable|numeric|min:0|max:1000000000000','max_price'=>'nullable|numeric|min:0|max:1000000000000'.($this->min_price!==''?'|gte:min_price':''),'bedrooms'=>'nullable|integer|min:0|max:20','sort'=>'required|in:featured,newest,price_asc,price_desc'];
    }
    public function updated($name): void { $this->resetPage(); $this->resetValidation($name); }
    public function resetFilters(): void { $this->reset('location','property_type','category','currency','min_price','max_price','bedrooms','sort'); $this->resetPage(); $this->resetValidation(); }
    #[Computed] public function results() {
        $valid = validator($this->only(array_keys($this->rules())), $this->rules());
        if ($valid->fails()) return Listing::query()->whereRaw('1=0')->paginate(9);
        return app(ListingSearch::class)->query($valid->validated())->paginate(9);
    }
    #[Computed] public function locations() { return Listing::published()->where('kind','property')->distinct()->orderBy('location')->pluck('location'); }
    public function applyFilters(): void { $this->validate(); $this->resetPage(); }
};
?>

<div class="property-page">
    <section class="catalogue-hero page-shell"><div class="catalogue-hero-copy"><p class="eyebrow">Find a property / Sale · Rent · Investment</p><h1>A place for<br>your <span>next.</span></h1><p>A new home. A fresh start. A different future.<br>Find the space that moves you forward.</p></div><img class="page-cutout property-cutout" src="{{ asset('assets/house-cutaway.webp') }}" width="1536" height="1024" alt="Cutaway model of a contemporary courtyard home"></section>
    <section class="catalogue-body page-shell" aria-label="Property search">
        <form class="catalogue-filter-form" wire:submit="applyFilters">
            <label>Location<select wire:model="location" aria-label="Property location"><option value="">Anywhere</option>@foreach($this->locations as $area)<option value="{{ $area }}">{{ $area }}</option>@endforeach</select></label>
            <label>Property type<select wire:model="property_type" aria-label="Property type"><option value="">Any type</option>@foreach(config('grei.property_types') as $key=>$label)<option value="{{ $key }}">{{ $label }}</option>@endforeach</select></label>
            <label>I’m looking to<select wire:model="category" aria-label="Sale or rental category"><option value="">Explore all</option><option value="sale">Buy a home</option><option value="rent">Rent a space</option><option value="investment">Invest</option></select></label>
            <label>Bedrooms<select wire:model="bedrooms" aria-label="Minimum bedrooms"><option value="">Any</option>@foreach(range(1,6) as $count)<option value="{{ $count }}">{{ $count }}+</option>@endforeach</select></label>
            <label class="filter-currency">Currency<select wire:model="currency" aria-label="Price currency">@foreach(config('grei.currencies') as $code)<option value="{{ $code }}">{{ $code }}</option>@endforeach</select></label>
            <label>Min. price<input wire:model="min_price" type="number" min="0" step="1" placeholder="No minimum" aria-label="Minimum price"></label>
            <label>Max. price<input wire:model="max_price" type="number" min="0" step="1" placeholder="No maximum" aria-label="Maximum price"></label>
            <button type="submit" class="solid-button" wire:loading.attr="disabled"><span wire:loading.remove wire:target="applyFilters">Find my space</span><span wire:loading wire:target="applyFilters">Searching…</span><x-grei.icon name="magnifying-glass" /></button>
        </form>
        @if($errors->any())<div class="form-errors" role="alert">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
        <div class="catalogue-results-heading"><p aria-live="polite"><strong>{{ $this->results->total() }}</strong> {{ Str::plural('space', $this->results->total()) }} to consider</p><div><button wire:click="resetFilters" type="button" class="text-link">Reset filters</button><label>Sort by<select wire:model.live="sort" aria-label="Sort properties"><option value="featured">GREI selection</option><option value="newest">Newest first</option><option value="price_asc">Price: low to high</option><option value="price_desc">Price: high to low</option></select></label></div></div>
        @if($this->results->contains('is_demo',true))<p class="preview-notice">Preview collection. Images, districts, specifications and prices marked “concept” are illustrative. Ask GREI about current verified listings.</p>@endif
        <div class="listing-grid" wire:loading.class="is-loading" wire:target="applyFilters,sort">@forelse($this->results as $listing)<x-grei.listing-card :listing="$listing" />@empty<div class="catalogue-empty"><span class="empty-asterisk">✳</span><h2>Your space is still out there.</h2><p>Try a wider location or budget, or tell us what you have in mind. We’ll help you explore the possibilities.</p><button class="solid-button" wire:click="resetFilters" type="button">Reset my search<x-grei.icon name="arrow-up-right" /></button><a class="text-link" href="{{ route('contact', ['service'=>'property']) }}">Ask GREI to help</a></div>@endforelse</div>
        <div class="catalogue-pagination">{{ $this->results->links('components.grei.pagination') }}</div>
    </section>
    <section class="page-conversation page-shell"><span class="eyebrow">A conversation can open doors.</span><h2>Looking for something<br>a little more <span>you?</span></h2><a class="solid-button" href="{{ route('contact',['service'=>'property']) }}">Tell us your brief<x-grei.icon /></a></section>
</div>

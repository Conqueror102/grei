<?php

use App\Models\Listing;
use App\Services\ListingSearch;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::public'), Title('Find your stay — GREI')] class extends Component {
    use WithPagination;
    #[Url] public string $location = '';
    #[Url] public string $checkin = '';
    #[Url] public string $checkout = '';
    #[Url] public string $guests = '2';
    #[Url] public string $sort = 'featured';
    protected function rules(): array { return ['location'=>'nullable|string|max:100','checkin'=>'nullable|required_with:checkout|date_format:Y-m-d|after_or_equal:today','checkout'=>'nullable|required_with:checkin|date_format:Y-m-d|after:checkin','guests'=>'required|integer|min:1|max:50','sort'=>'required|in:featured,newest,price_asc,price_desc']; }
    public function updated($name): void { $this->resetPage(); $this->resetValidation($name); }
    public function search(): void { $this->validate(); $this->resetPage(); }
    public function resetFilters(): void { $this->reset('location','checkin','checkout','guests','sort'); $this->resetValidation(); $this->resetPage(); }
    #[Computed] public function results() { $valid=validator($this->only(array_keys($this->rules())),$this->rules()); return $valid->fails()?Listing::query()->whereRaw('1=0')->paginate(9):app(ListingSearch::class)->query($valid->validated(),'stay')->paginate(9); }
    #[Computed] public function locations() { return Listing::published()->where('kind','stay')->distinct()->orderBy('location')->pluck('location'); }
};
?>

<div class="stays-page">
    <section class="stay-page-hero"><div class="page-shell stay-page-hero-inner"><p class="eyebrow">GREI stays / Feel at home, away.</p><h1>Check in.<br><span>Breathe out.</span></h1><p>A thoughtful space. A softer pace.<br>Find your place for a few nights, or a little longer.</p><img class="page-cutout stay-page-keys" src="{{ asset('assets/stay-keys.webp') }}" width="1312" height="1199" alt=""></div></section>
    <section class="page-shell stay-list-section">
        <form class="stay-search-form" wire:submit="search"><label>Where to?<select wire:model="location" aria-label="Stay location"><option value="">Anywhere</option>@foreach($this->locations as $area)<option value="{{ $area }}">{{ $area }}</option>@endforeach</select></label><label>Check in<input type="date" wire:model="checkin" min="{{ now()->toDateString() }}" aria-label="Check-in date"></label><label>Check out<input type="date" wire:model="checkout" min="{{ now()->addDay()->toDateString() }}" aria-label="Check-out date"></label><label>Guests<select wire:model="guests" aria-label="Guests">@foreach(range(1,8) as $count)<option value="{{ $count }}">{{ $count }} {{ Str::plural('guest',$count) }}</option>@endforeach</select></label><button type="submit" class="solid-button" wire:loading.attr="disabled">Find a stay<x-grei.icon name="magnifying-glass" /></button></form>
        @if($errors->any())<div role="alert" class="form-errors">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif
        <div class="catalogue-results-heading"><p aria-live="polite"><strong>{{ $this->results->total() }}</strong> {{ Str::plural('stay',$this->results->total()) }}{{ $checkin && $checkout ? ' matching your dates' : ' to settle into' }}</p><div><button type="button" class="text-link" wire:click="resetFilters">Reset search</button><label>Sort by<select wire:model.live="sort" aria-label="Sort stays"><option value="featured">GREI selection</option><option value="price_asc">Nightly rate: low to high</option><option value="price_desc">Nightly rate: high to low</option><option value="newest">Newest first</option></select></label></div></div>
        @if($this->results->contains('is_demo',true))<p class="preview-notice">These concept apartments and rates illustrate the experience. GREI confirms actual apartment details and availability before a reservation.</p>@endif
        <div class="listing-grid stay-list-grid">@forelse($this->results as $listing)<x-grei.listing-card :listing="$listing" />@empty<div class="catalogue-empty"><h2>Let’s find another way to stay.</h2><p>Try different dates, a smaller party or another location. You can also ask GREI for a personal recommendation.</p><button type="button" wire:click="resetFilters" class="solid-button">Explore all stays<x-grei.icon /></button><a class="text-link" href="{{ route('contact',['service'=>'stay']) }}">Talk to GREI</a></div>@endforelse</div>
        <div class="catalogue-pagination">{{ $this->results->links('components.grei.pagination') }}</div>
    </section>
    <section class="stay-reassurance page-shell"><p class="eyebrow">The little things that make a stay.</p><div><h2>Room to live.<br>Space to <span>unwind.</span></h2><p>Explore each apartment’s amenities and the details that matter to you. Share your dates directly with GREI on WhatsApp, and we’ll confirm everything before you arrive.</p></div><img src="{{ asset('assets/slow-morning.webp') }}" width="1536" height="1024" alt="Quiet morning light on a furnished bedroom" loading="lazy"></section>
</div>

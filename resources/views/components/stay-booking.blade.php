<?php

use App\Models\Listing;
use App\Services\BrandSettings;
use App\Services\StayAvailability;
use App\Services\WhatsApp;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component {
    #[Locked] public Listing $listing;
    public string $checkin=''; public string $checkout=''; public int $guests=2;
    #[Locked] public ?array $availability=null;
    public function mount(Listing $listing): void {
        abort_unless($listing->isPublic() && $listing->kind==='stay',404); $this->listing=$listing;
        $this->guests=min(2,$listing->guest_capacity ?: 1);
        foreach(['checkin','checkout'] as $field){ $value=request()->query($field,''); if(is_string($value) && preg_match('/^\d{4}-\d{2}-\d{2}$/',$value))$this->$field=$value; }
        if(is_numeric(request()->query('guests')))$this->guests=max(1,min((int)request()->query('guests'),$listing->guest_capacity ?: 1));
    }
    public function updated(): void { $this->availability=null; $this->resetValidation(); }
    public function check(): void {
        $this->listing->refresh();
        $this->availability=app(StayAvailability::class)->check($this->listing,$this->checkin,$this->checkout,$this->guests);
    }
    public function book() {
        $this->check();
        if(!$this->availability['available'])return;
        $message=app(WhatsApp::class)->stayMessage($this->listing,$this->checkin,$this->checkout,$this->guests);
        $url=app(WhatsApp::class)->link($message);
        return $url ? redirect()->away($url) : redirect()->route('contact',['service'=>'stay','listing'=>$this->listing->id,'checkin'=>$this->checkin,'checkout'=>$this->checkout,'guests'=>$this->guests]);
    }
};
?>

<div class="booking-panel">
    <p class="eyebrow">Make room for a little time away.</p><div class="booking-rate">{{ $listing->priceLabel() }}<small> / night</small></div>@if($listing->is_demo)<p class="demo-rate-note">Illustrative rate · concept apartment</p>@endif
    <form wire:submit="check" class="public-enquiry-form"><div class="form-pair"><label>Check in<input type="date" wire:model="checkin" min="{{ now()->toDateString() }}" required></label><label>Check out<input type="date" wire:model="checkout" min="{{ now()->addDay()->toDateString() }}" required></label></div><label>Guests<select wire:model="guests">@foreach(range(1,$listing->guest_capacity ?: 1) as $number)<option value="{{ $number }}">{{ $number }} {{ Str::plural('guest',$number) }}</option>@endforeach</select></label>@if($errors->any())<div class="form-errors" role="alert">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif<button type="submit" class="outline-button" wire:loading.attr="disabled">Check these dates<x-grei.icon name="calendar-blank" /></button></form>
    @if($availability)<div class="availability-result {{ $availability['available'] ? 'is-available' : 'is-unavailable' }}" role="status">@if($availability['available'])<h3>{{ $listing->is_demo ? 'Dates open in this demo.' : 'These dates look good.' }}</h3><p>{{ $availability['nights'] }} {{ Str::plural('night',$availability['nights']) }} · {{ $guests }} {{ Str::plural('guest',$guests) }}</p>@if($availability['total_minor'] !== null)<p class="booking-total">{{ $listing->currency }} {{ number_format($availability['total_minor']/100,2) }}<small>Accommodation estimate</small></p>@endif<p>GREI confirms the actual apartment, final total and any additional charges before your reservation.</p><button wire:click="book" wire:loading.attr="disabled" type="button" class="solid-button">{{ app(BrandSettings::class)->whatsappNumber() ? 'Book on WhatsApp' : 'Send a stay enquiry' }}<x-grei.icon name="whatsapp-logo" /></button>@else<h3>Let’s try different dates.</h3><p>These dates overlap an unavailable period. Change your dates or ask GREI about another apartment.</p><a href="{{ route('contact',['service'=>'stay']) }}" class="text-link">Help me find a stay<x-grei.icon /></a>@endif</div>@endif
    <p class="booking-note">{{ $listing->min_nights }}–{{ $listing->max_nights }} nights · Up to {{ $listing->guest_capacity }} guests.<br>Checking dates does not hold or confirm a reservation.</p>
</div>

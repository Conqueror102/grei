<?php

use App\Actions\StoreEnquiry;
use App\Models\Listing;
use App\Models\Project;
use App\Services\WhatsApp;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Support\Str;
use Livewire\Attributes\Locked;
use Livewire\Component;

new class extends Component {
    public string $name=''; public string $email=''; public string $phone=''; public string $message='';
    public string $service='general'; public bool $consent=false; public string $website='';
    #[Locked] public ?int $listingId=null;
    #[Locked] public ?int $projectId=null;
    #[Locked] public string $submissionToken='';
    #[Locked] public ?string $reference=null;
    #[Locked] public ?string $whatsappUrl=null;
    public string $checkin=''; public string $checkout=''; public ?int $guests=null;

    public function mount(string $service='general', ?int $listingId=null, ?int $projectId=null, string $message='', string $checkin='', string $checkout='', ?int $guests=null): void {
        $this->service=in_array($service,['property','stay','design','general'])?$service:'general';
        $this->listingId=$listingId; $this->projectId=$projectId; $this->message=$message;
        $this->checkin=$checkin; $this->checkout=$checkout; $this->guests=$guests;
        $this->submissionToken=(string)Str::uuid();
        if($listingId){ $listing=Listing::findOrFail($listingId); abort_unless($listing->isPublic(),404); $this->service=$listing->kind==='stay'?'stay':'property'; }
        if($projectId){ abort_unless(Project::findOrFail($projectId)->isPublic(),404); $this->service='design'; }
    }
    public function submit(): void {
        $key='grei-enquiry:'.request()->ip();
        if(RateLimiter::tooManyAttempts($key,5)){ $this->addError('message','Please wait a minute before sending another enquiry.'); return; }
        RateLimiter::hit($key,60);
        $record=app(StoreEnquiry::class)->handle([
            'submission_token'=>$this->submissionToken,'name'=>$this->name,'email'=>$this->email,'phone'=>$this->phone,
            'service'=>$this->service,'message'=>$this->message,'consent'=>$this->consent,'website'=>$this->website,
            'listing_id'=>$this->listingId,'project_id'=>$this->projectId,'checkin'=>$this->checkin?:null,'checkout'=>$this->checkout?:null,'guests'=>$this->guests,
        ]);
        $this->reference=$record->reference;
        $this->whatsappUrl=app(WhatsApp::class)->link("Hello GREI, my name is {$record->name}.\n\n{$record->message}\n\nEnquiry: {$record->reference}");
        $this->dispatch('grei:layout-change');
    }
    public function startAgain(): void { $this->reset('name','email','phone','message','consent','reference','whatsappUrl'); $this->submissionToken=(string)Str::uuid(); $this->resetValidation(); }
};
?>

<div class="enquiry-panel">
    @if($reference)
        <div class="enquiry-success" role="status"><x-grei.icon name="check" /><p class="eyebrow">A good place to start.</p><h2>Your enquiry<br>is with GREI.</h2><p>We’ll respond using the contact details you shared. A reservation or appointment is confirmed directly with the team.</p><p class="enquiry-reference">Reference: {{ $reference }}</p>@if($whatsappUrl)<a class="solid-button" href="{{ $whatsappUrl }}" target="_blank" rel="noopener noreferrer">Continue on WhatsApp<x-grei.icon name="whatsapp-logo" /></a>@endif<button type="button" wire:click="startAgain" class="text-link">Send another enquiry</button></div>
    @else
        <form wire:submit="submit" class="public-enquiry-form" novalidate>
            @if(!$listingId && !$projectId)<label>I’m interested in<select wire:model="service"><option value="general">A general conversation</option><option value="property">Finding a property</option><option value="stay">Booking a stay</option><option value="design">Designing a space</option></select>@error('service')<span class="field-error">{{ $message }}</span>@enderror</label>@endif
            <div class="form-pair"><label>Your name<input type="text" wire:model="name" autocomplete="name" maxlength="100" required>@error('name')<span class="field-error">{{ $message }}</span>@enderror</label><label>Email address<input type="email" wire:model="email" autocomplete="email" maxlength="254" required>@error('email')<span class="field-error">{{ $message }}</span>@enderror</label></div>
            <label>Phone / WhatsApp <small>(optional)</small><input type="tel" wire:model="phone" autocomplete="tel" maxlength="35">@error('phone')<span class="field-error">{{ $message }}</span>@enderror</label>
            @if($service==='stay')<div class="form-pair"><label>Check in <small>(optional)</small><input type="date" wire:model="checkin" min="{{ now()->toDateString() }}">@error('checkin')<span class="field-error">{{ $message }}</span>@enderror</label><label>Check out<input type="date" wire:model="checkout" min="{{ now()->addDay()->toDateString() }}">@error('checkout')<span class="field-error">{{ $message }}</span>@enderror</label></div><label>Number of guests <small>(optional)</small><input type="number" wire:model="guests" min="1" max="50">@error('guests')<span class="field-error">{{ $message }}</span>@enderror</label>@endif
            <label>What do you have in mind?<textarea wire:model="message" rows="5" minlength="10" maxlength="5000" required placeholder="Your preferred location, budget, dates, or the space you’re imagining…"></textarea>@error('message')<span class="field-error">{{ $message }}</span>@enderror</label>
            <div class="form-honeypot" aria-hidden="true"><label>Website<input type="text" wire:model="website" tabindex="-1" autocomplete="off"></label></div>
            <label class="consent-label"><input type="checkbox" wire:model="consent" required><span>I agree that GREI can use these details to respond to my enquiry. <a href="{{ route('privacy') }}">Privacy notice</a></span></label>@error('consent')<p class="field-error">{{ $message }}</p>@enderror
            @error('submission_token')<p class="field-error" role="alert">{{ $message }}</p>@enderror
            <button type="submit" class="solid-button" wire:loading.attr="disabled" wire:target="submit"><span wire:loading.remove wire:target="submit">Send my enquiry</span><span wire:loading wire:target="submit">Sending…</span><x-grei.icon /></button>
        </form>
    @endif
</div>

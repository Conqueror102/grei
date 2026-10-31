<?php
use App\Livewire\AdminComponent;
use App\Models\Listing;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Locked;
new class extends AdminComponent {
    #[Locked] public int $listingId;
    public string $starts_on='';public string $ends_on='';public string $note='';public bool $showArchived=false;
    public function mount(int $listingId):void{$this->listingId=$listingId;abort_unless($this->record()->kind==='stay',404);}
    public function record(){return Listing::findOrFail($this->listingId);}
    #[Computed] public function blocks(){return $this->record()->blocks()->when($this->showArchived,fn($q)=>$q->withTrashed())->orderByDesc('starts_on')->get();}
    public function block():void{$data=$this->validate(['starts_on'=>'required|date_format:Y-m-d','ends_on'=>'required|date_format:Y-m-d|after:starts_on','note'=>'nullable|string|max:255']);$block=$this->record()->blocks()->whereDate('starts_on',$this->starts_on)->whereDate('ends_on',$this->ends_on)->first();if($block)$block->update(['note'=>$data['note']]);else $this->record()->blocks()->create($data);$this->reset('starts_on','ends_on','note');unset($this->blocks);session()->flash('availability-status','Unavailable dates saved.');}
    public function unblock(int $id):void{$this->record()->blocks()->findOrFail($id)->delete();unset($this->blocks);}
    public function restore(int $id):void{$this->record()->blocks()->onlyTrashed()->findOrFail($id)->restore();unset($this->blocks);}
};
?>
<section class="admin-panel"><div class="admin-panel-heading"><div><h2>Stay availability</h2><p>Block booked or unavailable periods. The end date is the first day guests can arrive again.</p></div><label class="admin-check"><input type="checkbox" wire:model.live="showArchived">Show removed periods</label></div><form wire:submit="block" class="admin-availability-form"><div class="form-triple"><label>Unavailable from<input type="date" wire:model="starts_on" required></label><label>Available again on<input type="date" wire:model="ends_on" required></label><label>Private note<input wire:model="note" maxlength="255" placeholder="Booking, maintenance…"></label></div>@if($errors->any())<div class="form-errors" role="alert">@foreach($errors->all() as $error)<p>{{ $error }}</p>@endforeach</div>@endif<button class="solid-button" type="submit">Save unavailable dates<x-grei.icon name="calendar-blank" /></button></form>@if(session('availability-status'))<p class="admin-flash" role="status">{{ session('availability-status') }}</p>@endif<div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Unavailable from</th><th>Available again</th><th>Private note</th><th>Action</th></tr></thead><tbody>@forelse($this->blocks as $block)<tr wire:key="block-{{ $block->id }}"><td>{{ $block->starts_on->format('d M Y') }}</td><td>{{ $block->ends_on->format('d M Y') }}</td><td>{{ $block->note }}</td><td>@if($block->trashed())<button class="text-link" type="button" wire:click="restore({{ $block->id }})">Restore block</button>@else<button class="text-link" type="button" wire:click="unblock({{ $block->id }})" wire:confirm="Make these dates available again?">Make available</button>@endif</td></tr>@empty<tr><td colspan="4">No unavailable periods set. All dates within stay limits are open for enquiries.</td></tr>@endforelse</tbody></table></div></section>

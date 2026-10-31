<?php
use App\Livewire\AdminComponent;
use App\Models\Enquiry;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Url;
use Livewire\WithPagination;

new #[Layout('layouts::admin')] class extends AdminComponent {
    use WithPagination;
    #[Url] public string $search='';#[Url] public string $service='';#[Url] public string $status='';
    public function updated():void{$this->resetPage();}
    #[Computed] public function enquiries(){return Enquiry::with(['listing','project'])->when($this->status==='archived',fn($q)=>$q->onlyTrashed())->when(in_array($this->status,['new','contacted','closed']),fn($q)=>$q->where('status',$this->status))->when(in_array($this->service,['property','stay','design','general']),fn($q)=>$q->where('service',$this->service))->when($this->search,fn($q)=>$q->where(fn($q)=>$q->where('name','like','%'.$this->search.'%')->orWhere('email','like','%'.$this->search.'%')->orWhere('reference','like','%'.$this->search.'%')))->latest()->paginate(15);}
    public function restore(int $id):void{Enquiry::onlyTrashed()->findOrFail($id)->restore();}
};
?>
<div><header class="admin-page-heading"><div><p class="eyebrow">Your next conversations.</p><h1>Enquiry inbox</h1><p>Property, stay and design enquiries in one place.</p></div></header><div class="admin-filterbar"><input type="search" wire:model.live.debounce.300ms="search" placeholder="Name, email or reference" aria-label="Search enquiries"><select wire:model.live="service" aria-label="Service"><option value="">All services</option><option value="property">Property</option><option value="stay">Stays</option><option value="design">Design</option><option value="general">General</option></select><select wire:model.live="status" aria-label="Enquiry status"><option value="">Active enquiries</option><option value="new">New</option><option value="contacted">Contacted</option><option value="closed">Closed</option><option value="archived">Archived</option></select></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>From</th><th>Service / space</th><th>Received</th><th>Status</th><th>Action</th></tr></thead><tbody>@forelse($this->enquiries as $enquiry)<tr wire:key="enquiry-{{ $enquiry->id }}"><td><strong>{{ $enquiry->name }}</strong><small>{{ $enquiry->email }}</small></td><td>{{ ucfirst($enquiry->service) }}<small>{{ $enquiry->listing?->title ?? $enquiry->project?->title }}</small></td><td>{{ $enquiry->created_at->format('d M Y, H:i') }}</td><td><span class="status-pill">{{ $enquiry->trashed()?'Archived':ucfirst($enquiry->status) }}</span></td><td>@if($enquiry->trashed())<button wire:click="restore({{ $enquiry->id }})" type="button" class="text-link">Restore</button>@else<a href="{{ route('admin.enquiries.show',$enquiry) }}" class="text-link">Read enquiry<x-grei.icon /></a>@endif</td></tr>@empty<tr><td colspan="5">No enquiries match this view.</td></tr>@endforelse</tbody></table></div>{{ $this->enquiries->links('components.grei.pagination') }}</div>

<?php
use App\Livewire\AdminComponent;
use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\WithPagination;
new #[Layout('layouts::admin')] class extends AdminComponent {
    use WithPagination;
    public string $search='';public string $status='';
    public function updated():void{$this->resetPage();}
    #[Computed] public function projects(){return Project::with('media')->when($this->status==='archived',fn($q)=>$q->onlyTrashed())->when(in_array($this->status,['draft','published']),fn($q)=>$q->where('status',$this->status))->when($this->search,fn($q)=>$q->where('title','like','%'.$this->search.'%'))->latest()->paginate(12);}
    public function archive(int $id):void{Project::findOrFail($id)->delete();}
    public function restore(int $id):void{Project::onlyTrashed()->findOrFail($id)->restore();}
};
?>
<div><header class="admin-page-heading"><div><p class="eyebrow">The design studio</p><h1>Project portfolio</h1><p>Give each space its own story.</p></div><a class="solid-button" href="{{ route('admin.projects.create') }}">Add a project<x-grei.icon name="plus" /></a></header><div class="admin-filterbar"><input type="search" wire:model.live.debounce.300ms="search" placeholder="Search project title" aria-label="Search projects"><select wire:model.live="status" aria-label="Project status"><option value="">Active projects</option><option value="draft">Draft</option><option value="published">Published</option><option value="archived">Archived</option></select></div><div class="admin-table-wrap"><table class="admin-table"><thead><tr><th>Project</th><th>Category</th><th>Status</th><th>Actions</th></tr></thead><tbody>@forelse($this->projects as $project)<tr wire:key="admin-project-{{ $project->id }}"><td><div class="admin-space-cell"><img src="{{ $project->coverUrl() }}" alt="" width="70" height="58"><strong>{{ $project->title }}</strong></div></td><td>{{ ucfirst($project->category) }}{{ $project->is_demo?' · Demo':'' }}</td><td><span class="status-pill">{{ $project->trashed()?'Archived':ucfirst($project->status) }}</span></td><td><div class="admin-row-actions">@if($project->trashed())<button wire:click="restore({{ $project->id }})" type="button">Restore</button>@else<a href="{{ route('admin.projects.edit',$project->slug) }}">Edit</a>@if($project->isPublic())<a href="{{ route('projects.show',$project) }}" target="_blank" rel="noopener">View</a>@endif<button wire:click="archive({{ $project->id }})" wire:confirm="Archive this project? You can restore it later." type="button">Archive</button>@endif</div></td></tr>@empty<tr><td colspan="4">No projects match this view.</td></tr>@endforelse</tbody></table></div>{{ $this->projects->links('components.grei.pagination') }}</div>

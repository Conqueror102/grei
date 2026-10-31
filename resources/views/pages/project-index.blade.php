<?php
use App\Models\Project;
use Livewire\Attributes\Computed;
use Livewire\Attributes\Layout;
use Livewire\Attributes\Title;
use Livewire\Attributes\Url;
use Livewire\Component;
use Livewire\WithPagination;

new #[Layout('layouts::public'), Title('Interior design portfolio — GREI')] class extends Component {
    use WithPagination;
    #[Url] public string $category='';
    public function updatedCategory():void{$this->resetPage();}
    #[Computed] public function projects(){return Project::published()->with('media')->when($this->category,fn($q)=>$q->where('category',$this->category))->orderByDesc('featured')->latest()->paginate(8);}
};
?>
<div class="portfolio-page page-shell"><nav class="breadcrumbs" aria-label="Breadcrumb"><a href="{{ route('design') }}">Design studio</a><span>/</span><span>Our point of view</span></nav><header class="portfolio-heading"><p class="eyebrow">The GREI portfolio</p><h1>Spaces that<br>say <span>something.</span></h1><p>An exploration of the way architecture, materials and everyday rituals come together.</p></header><div class="portfolio-toolbar"><div class="collection-filters" role="group" aria-label="Filter design projects">@foreach([''=>'All projects','residential'=>'Residential','commercial'=>'Commercial','styling'=>'Styling'] as $key=>$label)<button type="button" wire:click="$set('category','{{ $key }}')" aria-pressed="{{ $category===$key?'true':'false' }}">{{ $label }}</button>@endforeach</div><span class="eyebrow" aria-live="polite">{{ $this->projects->total() }} {{ Str::plural('project',$this->projects->total()) }}</span></div><div class="portfolio-grid">@forelse($this->projects as $project)<x-grei.project-card :project="$project" />@empty<div class="catalogue-empty"><h2>A new story<br>could start with you.</h2><p>Talk to GREI about the space you’re imagining, or explore another project category.</p><button class="solid-button" type="button" wire:click="$set('category','')">Explore all projects<x-grei.icon /></button><a class="text-link" href="{{ route('design.consultation') }}">Start a design conversation</a></div>@endforelse</div><div class="catalogue-pagination">{{ $this->projects->links('components.grei.pagination') }}</div></div>

<x-grei.layout :title="$project->title.' — GREI Design'" :description="$project->summary">
    <x-grei.header />
    <main id="main-content" class="project-page">
        <div class="page-shell">
            <nav class="breadcrumbs" aria-label="Breadcrumb">
                <a href="{{ route('design') }}">Design studio</a>
                <span>/</span>
                <a href="{{ route('projects.index') }}">Portfolio</a>
                <span>/</span>
                <span>{{ $project->title }}</span>
            </nav>
            <div class="project-page-heading">
                <p class="eyebrow">{{ ucfirst($project->category) }}{{ $project->is_demo?' / Concept study':'' }}</p>
                <h1>{{ $project->title }}</h1>
                <p>{{ $project->summary }}</p>
            </div>
            @if($project->is_demo)
                <p class="preview-notice">A design concept exploring the GREI point of view. This is not presented as a completed commission.</p>
            @endif
            <x-grei.space-gallery :space="$project" />
            <section class="project-story">
                <div>
                    <p class="eyebrow">The story</p>
                    <h2>A space with<br>something to <span>say.</span></h2>
                </div>
                <div class="detail-prose">
                    {!! nl2br(e($project->story)) !!}
                    @if($project->approach)
                        <h3>The approach</h3>
                        <p>{!! nl2br(e($project->approach)) !!}</p>
                    @endif
                </div>
            </section>
            <div class="project-facts">
                @if($project->location)
                    <div><span class="eyebrow">Location</span><strong>{{ $project->location }}</strong></div>
                @endif
                @if($project->year)
                    <div><span class="eyebrow">Year</span><strong>{{ $project->year }}</strong></div>
                @endif
                @if($project->services)
                    <div><span class="eyebrow">The scope</span>@foreach($project->services as $item)<span>{{ $item }}</span>@endforeach</div>
                @endif
                @if($project->materials)
                    <div><span class="eyebrow">The material language</span>@foreach($project->materials as $item)<span>{{ $item }}</span>@endforeach</div>
                @endif
            </div>
            <x-grei.material-palette :space="$project" title="Material Palette & Texture Language" subtitle="Every tone, surface and grain chosen for its enduring tactile warmth." />
            <x-grei.curated-objects :space-title="$project->title" />
            <section class="project-consultation">
                <div>
                    <p class="eyebrow">A starting point for your own story.</p>
                    <h2>Like the feeling?<br>Make it <span>yours.</span></h2>
                    <img src="{{ asset('assets/design-assemblage.webp') }}" width="1536" height="1024" alt="" loading="lazy">
                </div>
                <livewire:enquiry-form service="design" :project-id="$project->id" :message="'I like the '.$project->title.' design direction. I’d love to discuss my own space.'" />
            </section>
        </div>
    </main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

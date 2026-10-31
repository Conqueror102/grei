@props(['space' => null, 'title' => 'Tactile language', 'subtitle' => 'The materials that shape the atmosphere.'])

@php
    $swatches = [
        ['name' => 'Roman Travertine', 'desc' => 'Honed limestone with porous tactile warmth', 'class' => 'swatch-travertine'],
        ['name' => 'Smoked French Oak', 'desc' => 'Deep architectural grain with natural oil finish', 'class' => 'swatch-oak'],
        ['name' => 'Brushed Patina Brass', 'desc' => 'Living metal crafted to age gracefully with touch', 'class' => 'swatch-brass'],
        ['name' => 'Textured Lime Plaster', 'desc' => 'Hand-trowelled matte surface diffusing daylight', 'class' => 'swatch-plaster'],
        ['name' => 'Washed Belgian Linen', 'desc' => 'Pure unbleached flax with relaxed drape', 'class' => 'swatch-linen'],
    ];
@endphp

<section class="material-palette-section" aria-labelledby="palette-title">
    <div class="material-palette-header">
        <div>
            <p class="eyebrow">Tactile Material Language</p>
            <h2 id="palette-title">{{ $title }}</h2>
        </div>
        <p>{{ $subtitle }}</p>
    </div>
    <div class="material-grid">
        @foreach($swatches as $swatch)
            <div class="material-card">
                <div>
                    <div class="material-swatch {{ $swatch['class'] }}"></div>
                    <strong>{{ $swatch['name'] }}</strong>
                </div>
                <span>{{ $swatch['desc'] }}</span>
            </div>
        @endforeach
    </div>
</section>
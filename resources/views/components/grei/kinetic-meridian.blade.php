@props(['size' => 64, 'label' => 'Solar Meridian'])

<div class="kinetic-meridian" style="--meridian-size: {{ $size }}px;" aria-label="{{ $label }}" role="img">
    <svg viewBox="0 0 100 100" class="meridian-svg" xmlns="http://www.w3.org/2000/svg">
        <!-- Outer Celestial Orbit -->
        <circle cx="50" cy="50" r="46" class="meridian-orbit-outer" />
        
        <!-- Dashed Compass Ring (Rotates slowly) -->
        <circle cx="50" cy="50" r="38" class="meridian-orbit-dashed" />
        
        <!-- Cardinal Marks -->
        <line x1="50" y1="4" x2="50" y2="10" class="meridian-tick" />
        <line x1="50" y1="90" x2="50" y2="96" class="meridian-tick" />
        <line x1="4" y1="50" x2="10" y2="50" class="meridian-tick" />
        <line x1="90" y1="50" x2="96" y2="50" class="meridian-tick" />
        
        <!-- Inner Geometric Diamond -->
        <polygon points="50,26 64,50 50,74 36,50" class="meridian-diamond" />
        
        <!-- Interactive Rotating Sun Needle -->
        <g class="meridian-needle">
            <line x1="50" y1="20" x2="50" y2="50" class="needle-north" />
            <circle cx="50" cy="20" r="3.5" class="needle-sun" />
            <line x1="50" y1="50" x2="50" y2="70" class="needle-south" />
        </g>
        
        <!-- Center Brass Pivot -->
        <circle cx="50" cy="50" r="4" class="meridian-pivot" />
    </svg>
</div>
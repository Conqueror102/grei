@props(['name' => 'arrow-up-right'])
<span {{ $attributes->merge(['class' => 'icon']) }} aria-hidden="true"><svg viewBox="0 0 256 256" focusable="false"><use href="{{ asset('assets/icons.svg') }}#{{ $name }}"></use></svg></span>

<x-grei.layout :title="$title ?? 'GREI — Staff access'">
    <main id="main-content" class="auth-page"><div class="auth-art"><a href="{{ route('home') }}" class="auth-brand">GREI</a><h1>A space<br>for what’s<br><span>next.</span></h1><img src="{{ asset('assets/metal-portal.webp') }}" width="500" height="500" alt=""><span class="eyebrow">THE GREI BACK ROOM</span></div><div class="auth-content">{{ $slot }}</div></main>
</x-grei.layout>

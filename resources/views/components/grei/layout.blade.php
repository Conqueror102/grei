@props(['title' => 'GREI — Spaces with a point of view.', 'description' => 'Distinctive properties, considered stays, and interiors shaped around you. Discover the world of GREI.'])
<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="theme-color" content="#F5F1E8">
    <meta name="description" content="{{ $description }}">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <link rel="canonical" href="{{ url()->current() }}">
    <title>{{ $title }}</title>
    <link rel="icon" type="image/png" href="{{ asset('assets/favicon.png') }}">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    @livewireStyles
</head>
<body data-whatsapp-number="{{ $brand->whatsappNumber() }}" data-enquiry-endpoint="{{ route('enquiries.store') }}">
    <a class="skip-link" href="#main-content">Skip to content</a>
    {{ $slot }}
    <x-grei.shortlist-drawer />
    @livewireScripts
</body>
</html>

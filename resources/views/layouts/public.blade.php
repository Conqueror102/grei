<x-grei.layout :title="$title ?? 'GREI — A considered way of living.'">
    <x-grei.header />
    <main id="main-content">{{ $slot }}</main>
    <x-grei.footer />
    <x-grei.enquiry-dialog />
    <x-grei.space-dialog />
</x-grei.layout>

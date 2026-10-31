<x-grei.layout :title="$heading.' — GREI'">
    <x-grei.header /><main id="main-content" class="policy-page page-shell"><p class="eyebrow">GREI / {{ $heading }}</p><h1>{{ $heading }}</h1>@if($brand->get('policy_updated_at'))<p class="detail-caption">Updated {{ $brand->get('policy_updated_at') }}</p>@endif<div class="policy-copy">{!! nl2br(e($brand->get($settingKey,$defaultText))) !!}</div><a class="text-link" href="{{ route('contact') }}">Contact GREI about this notice<x-grei.icon /></a></main><x-grei.footer /><x-grei.enquiry-dialog /><x-grei.space-dialog />
</x-grei.layout>

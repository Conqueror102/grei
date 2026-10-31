@props(['space'])
<div class="detail-gallery" data-detail-gallery>
    <div class="detail-gallery-main"><img src="{{ $space->gallery()[0]['src'] }}" alt="{{ $space->gallery()[0]['alt'] }}" width="1500" height="1000" data-gallery-main><button type="button" class="gallery-expand" data-gallery-expand><x-grei.icon name="arrows-out" /><span>View larger</span></button></div>
    @if(count($space->gallery())>1)<div class="detail-gallery-thumbs" aria-label="Space photographs">@foreach($space->gallery() as $index=>$image)<button type="button" data-gallery-src="{{ $image['src'] }}" data-gallery-alt="{{ $image['alt'] }}" aria-label="Show photograph {{ $index+1 }}" aria-pressed="{{ $index===0?'true':'false' }}"><img src="{{ $image['src'] }}" alt="" width="180" height="120" loading="lazy"></button>@endforeach</div>@endif
    <dialog class="gallery-lightbox" aria-label="Photograph viewer" data-lenis-prevent><button type="button" class="icon-button" data-gallery-close aria-label="Close photograph"><x-grei.icon name="x" /></button><img src="{{ $space->gallery()[0]['src'] }}" alt="{{ $space->gallery()[0]['alt'] }}" width="1500" height="1000"></dialog>
</div>

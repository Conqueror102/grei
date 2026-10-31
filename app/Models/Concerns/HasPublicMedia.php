<?php

namespace App\Models\Concerns;

use App\Models\Media;
use Illuminate\Database\Eloquent\Relations\MorphMany;

trait HasPublicMedia
{
    public function media(): MorphMany
    {
        return $this->morphMany(Media::class, 'mediable')->orderBy('position')->orderBy('id');
    }

    public function coverUrl(): string
    {
        $image = $this->media->firstWhere('kind', 'image');

        return $image ? route('media.show', $image) : asset($this->cover_asset ?: 'assets/courtyard-exterior.webp');
    }

    public function gallery(): array
    {
        $images = $this->media->where('kind', 'image')->map(fn (Media $media) => [
            'src' => route('media.show', $media), 'alt' => $media->alt ?: $this->title,
        ])->values()->all();

        return $images ?: [['src' => $this->coverUrl(), 'alt' => $this->title]];
    }
}

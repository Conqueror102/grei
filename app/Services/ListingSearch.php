<?php

namespace App\Services;

use App\Models\Listing;
use Illuminate\Database\Eloquent\Builder;

class ListingSearch
{
    public function query(array $filters, string $kind = 'property'): Builder
    {
        $query = Listing::published()->where('kind', $kind)->with('media');
        foreach (['location', 'property_type', 'category', 'currency'] as $field) {
            if (filled($filters[$field] ?? null)) $query->where($field, $filters[$field]);
        }
        if (filled($filters['bedrooms'] ?? null)) $query->where('bedrooms', '>=', (int) $filters['bedrooms']);
        if (filled($filters['guests'] ?? null)) $query->where('guest_capacity', '>=', (int) $filters['guests']);
        if (filled($filters['min_price'] ?? null)) $query->where('price_minor', '>=', (int) round((float) $filters['min_price'] * 100));
        if (filled($filters['max_price'] ?? null)) $query->where('price_minor', '<=', (int) round((float) $filters['max_price'] * 100));
        if ($kind === 'stay' && filled($filters['checkin'] ?? null) && filled($filters['checkout'] ?? null)) {
            $query->whereDoesntHave('blocks', fn ($q) => $q->whereDate('starts_on', '<', $filters['checkout'])->whereDate('ends_on', '>', $filters['checkin']));
            $nights = (int) \Carbon\CarbonImmutable::parse($filters['checkin'])->diffInDays(\Carbon\CarbonImmutable::parse($filters['checkout']));
            $query->where('min_nights', '<=', $nights)->where('max_nights', '>=', $nights);
        }
        return match ($filters['sort'] ?? 'featured') {
            'price_asc' => $query->orderByRaw('price_minor IS NULL')->orderBy('price_minor')->orderByDesc('id'),
            'price_desc' => $query->orderByRaw('price_minor IS NULL')->orderByDesc('price_minor')->orderByDesc('id'),
            'newest' => $query->latest(),
            default => $query->orderByDesc('featured')->latest(),
        };
    }
}

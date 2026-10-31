<?php

namespace App\Models;

use App\Models\Concerns\HasPublicMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\SoftDeletes;

class Listing extends Model
{
    use HasPublicMedia, SoftDeletes;

    protected $guarded = ['id'];

    protected function casts(): array
    {
        return ['amenities' => 'array', 'featured' => 'boolean', 'is_demo' => 'boolean', 'price_minor' => 'integer'];
    }

    public function getRouteKeyName(): string { return 'slug'; }

    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->when(! config('grei.show_demo'), fn ($q) => $q->where('is_demo', false));
    }

    public function isPublic(): bool
    {
        return ! $this->trashed() && $this->status === 'published' && (! $this->is_demo || config('grei.show_demo'));
    }

    public function blocks(): HasMany { return $this->hasMany(AvailabilityBlock::class); }

    public function priceLabel(): string
    {
        if ($this->price_minor === null) return 'Price on enquiry';
        $symbols = ['NGN' => '₦', 'USD' => '$', 'GBP' => '£', 'EUR' => '€'];
        return ($symbols[$this->currency] ?? $this->currency.' ').number_format($this->price_minor / 100, $this->price_minor % 100 ? 2 : 0);
    }
}

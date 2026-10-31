<?php

namespace App\Models;

use App\Models\Concerns\HasPublicMedia;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Project extends Model
{
    use HasPublicMedia, SoftDeletes;
    protected $guarded = ['id'];
    protected function casts(): array { return ['services' => 'array', 'materials' => 'array', 'featured' => 'boolean', 'is_demo' => 'boolean']; }
    public function getRouteKeyName(): string { return 'slug'; }
    public function scopePublished(Builder $query): Builder
    {
        return $query->where('status', 'published')->when(! config('grei.show_demo'), fn ($q) => $q->where('is_demo', false));
    }
    public function isPublic(): bool { return ! $this->trashed() && $this->status === 'published' && (! $this->is_demo || config('grei.show_demo')); }
}

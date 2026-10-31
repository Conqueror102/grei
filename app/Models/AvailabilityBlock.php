<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AvailabilityBlock extends Model
{
    use \Illuminate\Database\Eloquent\SoftDeletes;
    protected $guarded = ['id'];
    protected function casts(): array { return ['starts_on' => 'date', 'ends_on' => 'date']; }
    public function listing(): BelongsTo { return $this->belongsTo(Listing::class); }
}

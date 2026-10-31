<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Enquiry extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $hidden = ['submission_token', 'payload_hash', 'admin_notes'];
    protected function casts(): array { return ['checkin' => 'date', 'checkout' => 'date', 'consented_at' => 'datetime']; }
    public function listing(): BelongsTo { return $this->belongsTo(Listing::class); }
    public function project(): BelongsTo { return $this->belongsTo(Project::class); }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class Media extends Model
{
    use SoftDeletes;
    protected $guarded = ['id'];
    protected $table = 'media';
    public function mediable(): MorphTo { return $this->morphTo(); }
}

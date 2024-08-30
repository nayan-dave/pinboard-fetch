<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    public function pinboard(): BelongsTo
    {
        return $this->belongsTo(Pinboard::class, 'pinboard_id');
    }
}
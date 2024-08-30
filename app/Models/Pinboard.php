<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;


class Pinboard extends Model
{
    protected $table = 'pinboard';
    protected $primaryKey = 'id';
    
    public function tags(): HasMany
    {
        return $this->hasMany(Tag::class, 'pinboard_id');
    }
}

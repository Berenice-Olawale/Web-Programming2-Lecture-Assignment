<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Processor extends Model
{
    protected $fillable = [
        'manufacturer',
        'type',
    ];

    public function notebooks(): HasMany
    {
        return $this->hasMany(Notebook::class, 'processorid');
    }
}

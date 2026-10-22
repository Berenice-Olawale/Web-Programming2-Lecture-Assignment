<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Notebook extends Model
{
    protected $fillable = [
        'manufacturer',
        'type',
        'display',
        'memory',
        'harddisk',
        'videocontroller',
        'price',
        'processorid',
        'opsystemid',
        'pieces',
    ];

    public function processor(): BelongsTo
    {
        return $this->belongsTo(Processor::class, 'processorid');
    }

    public function operatingSystem(): BelongsTo
    {
        return $this->belongsTo(OperatingSystem::class, 'opsystemid');
    }
}

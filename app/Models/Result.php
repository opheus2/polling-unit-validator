<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Result extends Model
{
    use HasFactory;

    protected $fillable = [
        'party_id',
        'polling_unit_id',
        'score',
    ];

    public function polling_unit(): BelongsTo
    {
        return $this->belongsTo(PollingUnit::class);
    }
}

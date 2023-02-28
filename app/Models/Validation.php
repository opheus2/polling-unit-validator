<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Validation extends Model
{
    use HasFactory;

    protected $fillable = [
        'file',
        'score',
        'party_id',
        'polling_unit_id',
        'user_id',
    ];

    public function polling_unit(): BelongsTo
    {
        return $this->belongsTo(PollingUnit::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

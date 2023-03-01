<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOne;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'score',
        'party_id',
        'polling_unit_id',
        'ip_address',
    ];

    protected $hidden = [
        'created_at',
        'ip_address',
    ];

    public function polling_unit(): BelongsTo
    {
        return $this->belongsTo(PollingUnit::class);
    }
    
    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function validation(): HasOne
    {
        return $this->hasOne(Validation::class);
    }
}

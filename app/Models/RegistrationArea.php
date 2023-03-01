<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class RegistrationArea extends Model
{
    use HasFactory, UsesCode;

    /** Table should not be inserted into */
    protected $guarded = ['*'];

    public function local_government(): BelongsTo
    {
        return $this->belongsTo(LocalGovernment::class);
    }

    public function polling_units(): HasMany
    {
        return $this->hasMany(PollingUnit::class);
    }
}

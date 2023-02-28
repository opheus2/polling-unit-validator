<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class PollingUnit extends Model
{
    use HasFactory, UsesCode;

    protected $hidden = [
        'laravel_through_key'
    ];

     protected $table = "polling_units";

    /** Table should not be inserted into */
    protected $guarded = ['*'];

    public function registration_area(): BelongsTo
    {
        return $this->belongsTo(RegistrationArea::class);
    }

    public function results(): HasMany
    {
        return $this->hasMany(Result::class);
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class);
    }
}

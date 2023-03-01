<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\HasManyThrough;

class State extends Model
{
    use HasFactory, UsesCode;

    /** Table should not be inserted into */
    protected $guarded = ['*'];

    public function local_governments(): HasMany
    {
        return $this->hasMany(LocalGovernment::class);
    }

    public function registration_areas(): HasManyThrough
    {
        return $this->hasManyThrough(RegistrationArea::class, LocalGovernment::class);
    }
}

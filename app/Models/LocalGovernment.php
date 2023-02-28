<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory, UsesCode;

    /** Table should not be inserted into */
    protected $guarded = ['*'];
    protected $hidden = [
        'laravel_through_key'
    ];

    protected $table = "local_governments";

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function registration_areas()
    {
        return $this->hasMany(RegistrationArea::class);
    }

    public function polling_units()
    {
        return $this->hasManyThrough(PollingUnit::class, RegistrationArea::class);
    }
}

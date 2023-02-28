<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocalGovernment extends Model
{
    use HasFactory, UsesCode;

    protected $table = "local_governments";

    // protected $fillable = [
    //     'name',
    //     'abbreviation'
    // ];

    /** Table should not be inserted into */
    protected $guarded = ['*'];

    public function state()
    {
        return $this->belongsTo(State::class);
    }
    public function registration_areas()
    {
        return $this->hasMany(RegistrationArea::class);
    }
}

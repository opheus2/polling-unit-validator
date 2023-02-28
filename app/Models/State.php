<?php

namespace App\Models;

use App\Traits\UsesCode;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class State extends Model
{
    use HasFactory, UsesCode;

    protected $table = "states";

    // protected $fillable = [
    //     'name',
    //     'abbreviation',
    // ];

    /** Table should not be inserted into */
    protected $guarded = ['*'];

    public function local_governments(): HasMany
    {
        return $this->hasMany(LocalGovernment::class);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Party extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'icon',
    ];

    public function getIconAttribute($value)
    {
        if (!is_null($value)) {
            return url("/logos/" . $value);
        }

        return $value;
    }
}

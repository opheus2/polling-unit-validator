<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PuData extends Model
{
    /** Table should not be inserted into */
    use HasFactory;

    protected $table = 'pu_data';

    protected $guarded = ['*'];
}

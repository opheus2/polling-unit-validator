<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Submission extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'score',
        'party_id',
        'polling_unit_id',
    ];

    public function polling_unit()
    {
        return $this->belongsTo(PollingUnit::class);
    }
    
    public function party()
    {
        return $this->belongsTo(Party::class);
    }

    public function image()
    {
        return $this->belongsTo(Image::class);
    }
}

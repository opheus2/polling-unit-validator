<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $fillable = [
        'path',
        'count',
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getSubmissionCountAttributes()
    {
        return $this->submissions()->count();
    }
}

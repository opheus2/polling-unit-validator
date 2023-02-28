<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;

    protected $appends = ['url'];

    protected $fillable = [
        'path',
        'count',
    ];

    protected $hidden = [
        'created_at',
        'updated_at'
    ];

    public function submissions()
    {
        return $this->hasMany(Submission::class);
    }

    public function getSubmissionCountAttributes()
    {
        return $this->submissions()->count();
    }

    public function getUrlAttribute()
    {
        return url($this->path);
    }
}

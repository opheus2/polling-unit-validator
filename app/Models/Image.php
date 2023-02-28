<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    use HasFactory;
    protected $primaryKey = 'id';
    protected $fillable = [
        'path',
        'count',
    ];
    protected $appends = ['url'];

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

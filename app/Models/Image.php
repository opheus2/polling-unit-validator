<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Support\Facades\Cache;

class Image extends Model
{
    use HasFactory;

    protected $appends = ['url'];

    protected $fillable = [
        'path',
        'count',
        'validated_at',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'validated_at',
        'path',
    ];

    protected static function boot(): void
    {
        parent::boot();

        static::saved(function ($image) {
            Cache::forget('results.image.' . $image->id);
        });

        static::deleting(function ($image) {
            $image->submissions()->delete();
            $image->validations()->delete();
        });
    }

    public function submissions(): HasMany
    {
        return $this->hasMany(Submission::class);
    }

    public function parties(): HasMany
    {
        return $this->hasMany(Party::class);
    }

    public function validations(): HasMany
    {
        return $this->hasMany(Validation::class);
    }

    public function getSubmissionCountAttributes()
    {
        return $this->submissions()->count();
    }

    public function getUrlAttribute()
    {
        return url($this->path);
    }

    public function scopeValidated($query)
    {
        return $query->whereNotNull('validated_at');
    }

    public function scopePendingValidation($query)
    {
        return $query->whereNull('validated_at');
    }
}

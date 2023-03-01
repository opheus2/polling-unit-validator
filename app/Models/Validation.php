<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Cache;

class Validation extends Model
{
    use HasFactory;

    protected $fillable = [
        'image_id',
        'polling_unit_id',
        'user_id',
        'validated_at',
        'party_id',
        'score',
    ];
    
    protected static function boot(): void
    {
        parent::boot();

        static::saved(function ($model) {
            Cache::forget('results.image.' . $model->image_id);
            Cache::forget('results.lga.' . $model->polling_unit->registration_area->local_government_id);
            Cache::forget('results.state.' . $model->polling_unit->registration_area->local_government->state_id);
        });
    }

    public function polling_unit(): BelongsTo
    {
        return $this->belongsTo(PollingUnit::class);
    }

    public function image(): BelongsTo
    {
        return $this->belongsTo(Image::class);
    }

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

    public function party(): BelongsTo
    {
        return $this->belongsTo(Party::class);
    }

    public function submission(): BelongsTo
    {
        return $this->belongsTo(Submission::class);
    }
}

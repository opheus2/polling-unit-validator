<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\LocalGovernment;
use App\Models\State;
use App\Models\Submission;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function byImage(Image $image)
    {
        if (is_null($image->validated_at)) {
            return response()->json([
                'data' => [
                    'results' => [],
                ]
            ]);
        }

        $ttl = app()->environment('production') ? now()->addRealHour() : now()->addRealMinute();

        $results = Cache::remember('results.image.' . $image->id, $ttl, function () use ($image) {
            return collect($image->validations()
                ->with('party')
                ->get())
                ->map(function ($result) {
                    return [
                        'party' => $result->party->name,
                        'score' => $result->score,
                    ];
                });
        });

        return response()->json([
            'data' => [
                'results' => $results,
            ]
        ]);
    }

    public function byLocalGovernment(LocalGovernment $localGovernment)
    {
        $ttl = app()->environment('production') ? now()->addRealHour() : now()->addRealMinute();

        $results = Cache::remember('results.lga.' . $localGovernment->id, $ttl, function () use ($localGovernment) {
            $results = $localGovernment->polling_units()
                ->whereHas('validations')
                ->with('validations.party')
                ->get();

            if ($results->isEmpty()) {
                return [];
            }

            return $results->map(function ($pollingUnit) {
                return $pollingUnit->validations->map(function ($validation) {
                    return [
                        'party' => $validation->party->name,
                        'score' => $validation->score,
                    ];
                })->groupBy('party')
                    ->map(function ($party) {
                        return [
                            'party' => $party->first()['party'],
                            'score' => $party->sum('score'),
                        ];
                    });
            })->flatten(1);
        });

        return response()->json([
            'data' => [
                'results' => $results,
            ]
        ]);
    }

    public function byState(State $state)
    {
        $ttl = app()->environment('production') ? now()->addRealHour() : now()->addRealMinute();

        $results = Cache::remember('results.state.' . $state->id, $ttl, function () use ($state) {
            $results = $state->registration_areas()
                ->whereHas('polling_units.validations', function ($query) {
                    $query->whereNotNull('score');
                })
                ->with('polling_units.validations.party')
                ->get();

            if ($results->isEmpty()) {
                return [];
            }

            return $results->map(function ($area) {
                return $area->polling_units
                    ->map(fn ($unit) => $unit->validations->map(function ($validation) {
                        return [
                            'party' => $validation->party->name,
                            'score' => $validation->score,
                        ];
                    })->groupBy('party')
                        ->map(function ($party) {
                            return [
                                'party' => $party->first()['party'],
                                'score' => $party->sum('score'),
                            ];
                        }))->flatten(1);
            })->flatten(1);
        });

        return response()->json([
            'data' => [
                'results' => $results,
            ]
        ]);
    }
}

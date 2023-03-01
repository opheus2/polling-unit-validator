<?php

namespace App\Http\Controllers\API;

use App\Models\Party;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranscribeRequest;
use App\Models\Image;
use App\Models\LocalGovernment;
use App\Models\State;
use Illuminate\Support\Facades\Log;

class TranscribeController extends Controller
{
    public function index()
    {
        $image = Image::query()
            ->where('count', 0)
            ->withCount('submissions')
            ->whereNull('validated_at')
            ->inRandomOrder('count')
            ->first();

        if (empty($image)) {
            $image = Image::query()
                ->withCount('submissions')
                ->whereNull('validated_at')
                ->inRandomOrder('count')
                ->first();
        }

        return response()->json([
            'data' => [
                'image' => $image,
                'states' => State::query()->get(),
                'parties' => Party::query()->get(['id', 'name']),
            ]
        ]);
    }

    public function lgas(State $state)
    {
        return response()->json([
            'data' => [
                'lgas' => $state->local_governments,
            ]
        ]);
    }

    public function units(LocalGovernment $local_government)
    {
        return response()->json([
            'data' => [
                'lgas' => $local_government->polling_units,
            ]
        ]);
    }

    public function store(StoreTranscribeRequest $request)
    {
        DB::beginTransaction();
        try {
            $image = Image::query()->findOrFail($request->image_id);

            if (is_null($image->validated_at)) {
                foreach ($request->parties as $party) {
                    $image->submissions()->create([
                        'party_id' => $party['id'],
                        'score' => $party['score'],
                        'ip_address' => $request->ip(),
                        'polling_unit_id' => $request->polling_unit_id,
                    ]);
                }

                $image->increment('count');

                DB::commit();
            }
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();

            return response()->json([
                'message' => 'Transcription failed! Please try again.',
                'error' => $th->getMessage(),
            ], 400);
        }

        return response()->json([
            'message' => 'Transcription successful! Thank you.',
        ], 200);
    }
}

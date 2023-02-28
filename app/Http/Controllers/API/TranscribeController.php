<?php

namespace App\Http\Controllers\API;

use App\Models\Party;
use App\Models\Submission;
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
        return response()->json([
            'data' => [
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

            foreach ($request->parties as $party) {
                Submission::query()->create([
                    'image_id' => $image->id,
                    'party_id' => $party['id'],
                    'score' => $party['score'],
                    'polling_unit_id' => $request->polling_unit_id,
                ]);
            }

            $image->increment('count');
            DB::commit();
        } catch (\Throwable $th) {
            Log::error($th->getMessage());
            DB::rollBack();

            return response()->json([
                'message' => 'Transcription failed! Please try again.',
            ], 500);
        }

        return response()->json([
            'message' => 'Transcription successful! Thank you.',
        ], 200);
    }
}

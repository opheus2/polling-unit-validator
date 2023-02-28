<?php

namespace App\Http\Controllers\API;

use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\StoreTranscribeRequest;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return response()->json([
            'data' => Submission::query()
                ->with('party')
                ->simplePaginate(25)
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show(Submission $submission)
    {
        return response()->json([
            'data' => $submission->load('party'),
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Submission $submission)
    {
        $submission->delete();

        return response()->json([
            'message' => 'Submission deleted successfully!',
        ], 200);
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Image;
use App\Models\Submission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class SubmissionController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $submissions = Image::query()
            ->pendingValidation()
            ->whereHas('submissions')
            ->withCount('submissions')
            ->paginate(25);

        return view('admin.submissions.index', compact('submissions'));
    }

    /**
     * Display a listing of the resource.
     */
    public function show(Image $submission)
    {
        $submission->load('submissions.party');
        $image = $submission;

        $submissions = $image->submissions->groupBy('session_id');
        return view('admin.submissions.show', compact('image', 'submissions'));
    }

    /**
     * Display a listing of the resource.
     */
    public function validateSubmission(Submission $submission)
    {
        try {
            DB::beginTransaction();
            $submissions = Submission::query()
                ->where('image_id', $submission->image_id)
                ->where('session_id', $submission->session_id)
                ->get();

            $submissions->each(function ($submission) {
                $submission->image->validations()->create([
                    'user_id' => auth()->id(),
                    'polling_unit_id' => $submission->polling_unit_id,
                    'party_id' => $submission->party_id,
                    'score' => $submission->score,
                    'validated_at' => now(),
                ]);

                $submission->image->update(['validated_at' => now()]);
            });

            session()->flash('success', 'Submission validated successfully');

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            Log::error($e->getMessage());
            dd($e->getMessage());
            return redirect()->back()->with('error', 'An error occurred while validating the submission');
        }

        return redirect()->route('submissions.index');
    }
}

<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\LocalGovernment;
use App\Models\PollingUnit;
use App\Models\State;
use App\Models\Submission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function __invoke(Request $request)
    {
        $ttl = app()->environment('production') ? now()->addRealHour() : now()->addRealMinute();

        $data = Cache::remember('admin.dashboard.metrics', $ttl, function () {
            return [
                'statesCount' => State::count(),
                'lgasCount' => LocalGovernment::count(),
                'pollingUnitsCount' => PollingUnit::count(),
                'submissionsCount' => Submission::count(),
                'validatedSubmissionsCount' => Submission::query()
                    ->whereHas('image', fn ($query) => $query->validated())
                    ->count(),
                'pendingValidationCount' => Submission::query()
                    ->whereHas('image', fn ($query) => $query->pendingValidation())
                    ->count(),
            ];;
        });

        return view('admin.dashboard')->with($data);
    }
}

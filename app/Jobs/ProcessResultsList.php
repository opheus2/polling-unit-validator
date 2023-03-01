<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Models\LocalGovernment;
use App\Models\PollingUnit;
use App\Models\RegistrationArea;
use App\Models\Result;
use App\Models\State;
use Illuminate\Support\Facades\Cache;

class ProcessResultsList implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Cache::delete('results');

        $states = State::all();
        $lgas = LocalGovernment::all();
        $results = [];
        foreach($states as $state) {
            $results[$state->id] = [
                'name' => $state->name, 
                'lgas' => []
            ];
        }

        // return $results;
        foreach($lgas as $lga){
            $results[$lga['state_id']]['lgas'][$lga->id] = ['name' => $lga->name];

            $registrationArea = RegistrationArea::where('local_government_id', $lga['id'])->with('polling_units')->get();

            $pollingUnites = $registrationArea->map(function ($registrationArea) {
                return $registrationArea->polling_units;
            });

            // for this polling unit get the results.
            $updatedPolls = $pollingUnites->flatten();
            foreach($updatedPolls as $poll){
                // get their results.
               $results[$lga['state_id']]['lgas'][$lga->id]['results'] = Result::where('polling_unit_id', $poll->id)->get()->all();
            }
        }

        Cache::rememberForever('results', function() use ($results){
            return $results;
        });
    }
}

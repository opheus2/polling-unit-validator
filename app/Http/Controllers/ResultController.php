<?php

namespace App\Http\Controllers;

use App\Jobs\ProcessResultsList;
use Illuminate\Contracts\Queue\Queue;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class ResultController extends Controller
{
    // return results.
    public function index(Request $request)
    {
        $state = $request->state;

        return Cache::get('results');
        
        // if($state == null){
        //     $results = Result::all();
        // }

    }

    public function process(Request $request){
        (new ProcessResultsList())->dispatch();

        return 'processing results, wait 5 mins';
    }
}

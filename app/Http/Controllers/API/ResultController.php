<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ResultController extends Controller
{
    public function index(Request $request)
    {
        $results = DB::table('submissions')
            ->select('party_id', DB::raw('count(*) as total'))
            ->groupBy('party_id')
            ->get();

        return response()->json([
            'data' => [
                'results' => $results,
            ]
        ]);
    }
}

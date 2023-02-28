<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class RandomController extends Controller
{
    public function index(Request $request)
    {
        $imagePaths = glob(public_path('images/*.{jpg,jpeg,png,gif}', GLOB_BRACE));

        $imageCounts = DB::table('images')
            ->select('path', 'count')
            ->whereIn('path', $imagePaths)
            ->get()
            ->keyBy('path');

        uasort($imagePaths, function ($a, $b) use ($imageCounts) {
            $aCount = $imageCounts[$a]->count ?? 0;
            $bCount = $imageCounts[$b]->count ?? 0;

            return $aCount <=> $bCount;
        });

        $leastUsedImages = array_filter($imagePaths, function ($path) use ($imageCounts) {
            return $imageCounts[$path]->count === 0;
        });

        if (! empty($leastUsedImages)) {
            $imagePath = array_rand($leastUsedImages);
        } else {
            $imagePaths = array_keys($imagePaths);
            $imageCounts = array_column($imageCounts->toArray(), 'count', 'path');
            $minCount = min($imageCounts);
            $leastUsedImages = array_filter($imageCounts, function ($count) use ($minCount) {
                return $count === $minCount;
            });
            $imagePath = array_rand($leastUsedImages);
        }

        DB::table('images')
            ->where('path', $imagePath)
            ->increment('count');

        return response()->file($imagePath);
    }
}

<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use RecursiveIteratorIterator;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Image;
use RecursiveDirectoryIterator;
use SplFileInfo;

class RandomController extends Controller
{
    public function index(Request $request)
    {
        $image = Image::query()
            ->where('count', 0)
            ->withCount('submissions')
            ->inRandomOrder('count')
            ->first();

        if (empty($image)) {
            $image = Image::query()
                ->withCount('submissions')
                ->min('count', 1)
                ->inRandomOrder('count')
                ->first();
        }

        return response()->json([
            'data' => [
                'image' => $image,
            ]
        ]);
    }
}

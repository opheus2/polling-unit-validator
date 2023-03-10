<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\API\ResultController;
use App\Http\Controllers\API\RandomController;
use App\Http\Controllers\API\TranscribeController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('v1')->group(function () {
    Route::get('random', [RandomController::class, 'index'])->name('random');
    Route::get('results/image/{image}', [ResultController::class, 'byImage'])->name('results.image');
    Route::get('results/lga/{localGovernment}', [ResultController::class, 'byLocalGovernment'])->name('results.lga');
    Route::get('results/states/{state}', [ResultController::class, 'byState'])->name('results.state');

    // Transcribe/Submission routes
    Route::apiResource('transcribe', TranscribeController::class)->only(['index', 'store']);
    Route::get('transcribe/state/{state}/lgas', [TranscribeController::class, 'lgas'])->name('transcribe.lga');
    Route::get('transcribe/lga/{local_government}/units', [TranscribeController::class, 'units'])->name('transcribe.units');
});

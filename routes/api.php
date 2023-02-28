<?php

use App\Http\Controllers\RandomController;
use App\Http\Controllers\ResultController;
use App\Http\Controllers\TranscribeController;
use App\Http\Controllers\ValidateController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
    Route::post('transcribe', [TranscribeController::class, 'index'])->name('transcribe');
    Route::get('results', [ResultController::class, 'index'])->name('results');
    Route::post('validate', [ValidateController::class, 'index'])->name('validate');
});

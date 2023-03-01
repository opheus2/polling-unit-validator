<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\ValidateController;
use App\Http\Controllers\API\SubmissionController;
use App\Http\Middleware\RedirectByAuth;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('elevated')->group(function () {
    Route::middleware([RedirectByAuth::class])->group(function () {
        Route::get('login', [AuthController::class, 'loginForm'])->name('login.view');
        Route::post('login', [AuthController::class, 'login'])->name('login.post');
    });
    Route::post('logout', [AuthController::class, 'logout'])->name('logout');

    Route::middleware(['auth'])->group(function () {
        Route::get('dashboard', DashboardController::class)->name('admin.dashboard');
        Route::apiResource('submissions', SubmissionController::class)->only(['index', 'show', 'destroy']);
        Route::post('validate', [ValidateController::class, 'index'])->name('validate');
    });
});

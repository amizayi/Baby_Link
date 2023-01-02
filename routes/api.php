<?php

use App\Http\Controllers\V1\Base\StatusController as V1TStatusController;
use App\Http\Controllers\V1\Base\TypeController as V1TypeController;
use App\Http\Controllers\V1\LinkController as V1LinkController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

// V1
Route::prefix('/v1')->group(function () {
    // Base
    Route::prefix('/base')->group(function () {
        // type
        Route::get('/type', [V1TypeController::class, 'index']);
        // status 
        Route::get('/status', [V1TStatusController::class, 'index']);
    });
    // Link
    Route::prefix('/link')->controller(V1LinkController::class)->group(function () { 
        Route::post('/store','store');
        Route::get('/{code}','show');
    });
});

<?php

use App\Http\Controllers\V1\Base\StatusController as V1TStatusController;
use App\Http\Controllers\V1\Base\TypeController as V1TypeController;
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
        Route::get('/type', [V1TStatusController::class, 'index']);
    });
});

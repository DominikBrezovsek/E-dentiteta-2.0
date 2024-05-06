<?php

use App\Http\Controllers\CronController;
use App\Http\Controllers\OrganisationAdminApiController;
use App\Http\Controllers\PasswordResetController;
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

Route::prefix('/OAD/')->group(function () {
    Route::post('login/', [OrganisationAdminApiController::class, 'login']);
    Route::middleware('OAD_API')->group(function () {
        Route::post('/getUser/', [OrganisationAdminApiController::class, 'getUser']);
    });
});

Route::prefix('/PRF/')->group(function () {
    Route::post('login/', [\App\Http\Controllers\TeaherApiController::class, 'login']);
});

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
    Route::post('/logout/' , [OrganisationAdminApiController::class, 'logout']);
    Route::middleware('OAD_API')->group(function () {
        Route::post('/getUser/', [OrganisationAdminApiController::class, 'getUser']);
        Route::post('/getCards/', [OrganisationAdminApiController::class, 'getCards']);
        Route::post('/createCard/', [OrganisationAdminApiController::class, 'createCard']);
        Route::post('/deleteCard/', [OrganisationAdminApiController::class, 'deleteCard']);
        Route::post('/updateCard/', [OrganisationAdminApiController::class, 'updateCard']);
        Route::post('/getStudents/', [OrganisationAdminApiController::class, 'getStudents']);
        Route::post('/updateStudent/', [OrganisationAdminApiController::class, 'updateStudent']);
        Route::post('/deleteStudent/', [OrganisationAdminApiController::class, 'deleteStudent']);
        Route::post('/getOrganisation/', [OrganisationAdminApiController::class, 'getOrganisation']);
        Route::post('/updateOrganisation/', [OrganisationAdminApiController::class, 'updateOrganisation']);
        Route::post('/getAdmin/', [OrganisationAdminApiController::class, 'getAdmin']);
        Route::post('/updateAdmin/', [OrganisationAdminApiController::class, 'updateAdmin']);
        Route::post('/getClasses/', [OrganisationAdminApiController::class, 'getClasses']);

    });
});

Route::prefix('/PRF/')->group(function () {
    Route::post('login/', [\App\Http\Controllers\TeaherApiController::class, 'login']);
});

<?php

use App\Http\Controllers\AddOrganisationController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RegisterController;
use Illuminate\Support\Facades\Route;

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
    return view('layout');
})->name('home');
/**
 * Route for logout
 */
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
/**
 * Routes for login
 */
Route::group(['middleware' => 'login'], function () {
    Route::get('/login', [LoginController::class, 'getLogin'])->name('login');
    Route::post('/login', [LoginController::class, 'postLogin'])->name('login.create');
});
/**
 * Routes for register
 */
Route::group(['middleware' => 'register'], function () {
    Route::get('/register', [RegisterController::class, 'getRegister'])->name('register');
    Route::post('/register', [RegisterController::class, 'postRegister'])->name('register.create');
});
/**
 * Routes for admin
 */
Route::group(['middleware' => 'ADM'], function () {

    Route::prefix('admin')->group(function (){
        /**
         * Routes for admin profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/edit', [ProfileController::class, 'getProfileAdmin'])->name('admin.profile');
            Route::post('/edit', [ProfileController::class, 'postProfileAdmin'])->name('admin.profile.update');
            Route::put('/edit', [ProfileController::class, 'postProfileAdmin'])->name('admin.profile.update');
        });
        Route::prefix('/organisations')->group(function (){
            Route::get('/', [AddOrganisationController::class, 'getOrganisations'])->name('admin.organisations');
            Route::get('/edit/{organisationId}', [AddOrganisationController::class, 'getOrganisation'])->name('admin.organisation');
            Route::post('/edit/{organisationId}', [AddOrganisationController::class, 'postOrganisation'])->name('admin.organisation.update');
            Route::put('/edit/{organisationId}', [AddOrganisationController::class, 'postOrganisation'])->name('admin.organisation.update');
            Route::get('/add', [AddOrganisationController::class, 'getAddOrganisation'])->name('admin.organisation.add');
            Route::post('/add', [AddOrganisationController::class, 'postAddOrganisation'])->name('admin.organisation.create');
            Route::put('/add', [AddOrganisationController::class, 'postAddOrganisation'])->name('admin.organisation.create');
            Route::delete('/delete/{organisationId}', [AddOrganisationController::class, 'deleteOrganisation'])->name('admin.organisation.delete');
        });

    });
});
/**
 * Routes for organisation
 */
Route::group(['middleware' => 'ORG'], function () {

    Route::prefix('organisation')->group(function (){
        /**
         * Routes for organisation profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/edit', [ProfileController::class, 'getProfileOrganisation'])->name('organisation.profile');
            Route::post('/edit', [ProfileController::class, 'postProfile'])->name('organisation.profile.update');
        });

    });
});
/**
 * Routes for user
 */
Route::group(['middleware' => 'USR'], function () {

    Route::prefix('user')->group(function (){
        /**
         * Routes for user profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/edit', [ProfileController::class, 'getProfileUser'])->name('user.profile');
            Route::post('/edit', [ProfileController::class, 'postProfile'])->name('user.profile.update');
        });

    });
});

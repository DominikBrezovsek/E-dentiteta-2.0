<?php

use App\Http\Controllers\AddOrganisationController;
use App\Http\Controllers\CheckCardController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\LogoutController;
use App\Http\Controllers\PasswordResetController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\QRCodeController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\AddCardController;
use App\Http\Controllers\AddUserController;
use App\Http\Controllers\AddUserCardController;
use App\Http\Controllers\OrganisationCardsController;
use App\Http\Controllers\AddUserOrganisationController;
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

Route::get('/',[LoginController::class, 'getLogin'])->name('home');
/**
 * Route for logout
 */
Route::get('/logout', [LogoutController::class, 'logout'])->name('logout');
/**
 * Routes for login
 */
Route::group(['middleware' => 'login'], function () {
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
 *Password reset route
 */
Route::get('/password-reset', [PasswordResetController::class, 'getForm'])->name('password-reset');
Route::post('/password-reset', [PasswordResetController::class, 'resetPassword'])->name('password-reset.create');
Route::get('/password-reset/set-new/', [PasswordResetController::class, 'getNewPasswordForm'])->name('set-new-password');
Route::post('/password-reset/post-new/', [PasswordResetController::class, 'setNewPassword'])->name('set-new-password.create');


/**
 *
 *Routes for system admin
 */

Route::group(['middleware' => 'SAD'], function () {
    Route::prefix('/user')->group(function () {
        Route::get('/edit', [ProfileController::class, 'getProfileUser'])->name('sad.profile');
        Route::post('/edit', [ProfileController::class, 'postProfileStudent'])->name('sad.profile.update');
        Route::put('/edit', [ProfileController::class, 'postProfileStudent'])->name('sad.profile.update');

        Route::prefix('/organisations')->group(function (){

        });
    });
});

/**
 * Routes for organisation_admin
 */
Route::group(['middleware' => 'OAD'], function () {

    Route::prefix('organisation_admin')->group(function (){
        /**
         * Routes for organisation_admin profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/edit', [ProfileController::class, 'getProfileAdmin'])->name('organisation_admin.profile');
            Route::post('/edit', [ProfileController::class, 'postProfileAdmin'])->name('organisation_admin.profile.update');
            Route::put('/edit', [ProfileController::class, 'postProfileAdmin'])->name('organisation_admin.profile.update');
        });
        Route::prefix('/organisations')->group(function (){
            Route::get('/', [AddOrganisationController::class, 'getOrganisations'])->name('organisation_admin.organisations');
            Route::get('/edit/{organisationId}', [AddOrganisationController::class, 'getOrganisation'])->name('organisation_admin.professor');
            Route::post('/edit/{organisationId}', [AddOrganisationController::class, 'postOrganisation'])->name('organisation_admin.professor.update');
            Route::put('/edit/{organisationId}', [AddOrganisationController::class, 'postOrganisation'])->name('organisation_admin.professor.update');
            Route::get('/add', [AddOrganisationController::class, 'getAddOrganisation'])->name('organisation_admin.professor.add');
            Route::post('/add', [AddOrganisationController::class, 'postAddOrganisation'])->name('organisation_admin.professor.create');
            Route::put('/add', [AddOrganisationController::class, 'postAddOrganisation'])->name('organisation_admin.professor.create');
            Route::delete('/delete/{organisationId}', [AddOrganisationController::class, 'deleteOrganisation'])->name('organisation_admin.professor.delete');
        });
        Route::prefix('/cards')->group(function (){
            Route::get('/', [AddCardController::class, 'getCards'])->name('organisation_admin.cards');
            Route::get('/edit/{cardId}', [AddCardController::class, 'getCard'])->name('organisation_admin.card');
            Route::post('/edit/{cardId}', [AddCardController::class, 'postCard'])->name('organisation_admin.card.update');
            Route::put('/edit/{cardId}', [AddCardController::class, 'postCard'])->name('organisation_admin.card.update');
            Route::get('/add', [AddCardController::class, 'getAddCard'])->name('organisation_admin.card.add');
            Route::post('/add', [AddCardController::class, 'postAddCard'])->name('organisation_admin.card.create');
            Route::put('/add', [AddCardController::class, 'postAddCard'])->name('organisation_admin.card.create');
            Route::delete('/delete/{cardId}', [AddCardController::class, 'deleteCard'])->name('organisation_admin.card.delete');
        });
        Route::prefix('/users')->group(function (){
            Route::get('/', [AddUserController::class, 'getUsers'])->name('organisation_admin.users');
            Route::get('/edit/{userId}', [AddUserController::class, 'getUser'])->name('organisation_admin.student');
            Route::post('/edit/{userId}', [AddUserController::class, 'postUser'])->name('organisation_admin.student.update');
            Route::put('/edit/{userId}', [AddUserController::class, 'postUser'])->name('organisation_admin.student.update');
            Route::get('/add', [AddUserController::class, 'getAddUser'])->name('organisation_admin.student.add');
            Route::post('/add', [AddUserController::class, 'postAddUser'])->name('organisation_admin.student.create');
            Route::put('/add', [AddUserController::class, 'postAddUser'])->name('organisation_admin.student.create');
            Route::delete('/delete/{userId}', [AddUserController::class, 'deleteUser'])->name('organisation_admin.student.delete');
        });

    });
});
/**
 * Routes for professor
 */
Route::group(['middleware' => 'PRF'], function () {

    Route::prefix('professor')->group(function (){
        /**
         * Routes for professor profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/edit', [ProfileController::class, 'getProfileProfessor'])->name('professor.profile');
            Route::post('/edit', [ProfileController::class, 'postProfileProfessor'])->name('professor.profile.update');
            Route::put('/edit', [ProfileController::class, 'postProfileProfessor'])->name('professor.profile.update');
        });
        //TODO: Add routes for cards check
        Route::prefix('/cards')->group(function(){
            Route::get('/', [OrganisationCardsController::class, 'getCards'])->name('professor.cards');
            Route::get('/edit/{cardId}', [OrganisationCardsController::class, 'getCard'])->name('professor.card');
            Route::post('/edit/{cardId}', [OrganisationCardsController::class, 'postCard'])->name('professor.card.update');
            Route::put('/edit/{cardId}', [OrganisationCardsController::class, 'postCard'])->name('professor.card.update');
            Route::get('/add', [OrganisationCardsController::class, 'getAddCard'])->name('professor.card.add');
            Route::post('/add', [OrganisationCardsController::class, 'postAddCard'])->name('professor.card.create');
            Route::put('/add', [OrganisationCardsController::class, 'postAddCard'])->name('professor.card.create');
            Route::get('/approve', [OrganisationCardsController::class, 'getApproveCards'])->name('professor.card.approve');
            Route::post('/approve/{requestId}', [OrganisationCardsController::class, 'getApproveCard'])->name('professor.card.approve.card');
            Route::put('/approve/{requestId}', [OrganisationCardsController::class, 'getApproveCard'])->name('professor.card.approve.card');
            Route::post('/decline/{requestId}', [OrganisationCardsController::class, 'getDeclineCard'])->name('professor.card.decline.card');
            Route::put('/decline/{requestId}', [OrganisationCardsController::class, 'getDeclineCard'])->name('professor.card.decline.card');
            Route::delete('/delete/{cardId}', [OrganisationCardsController::class, 'deleteCard'])->name('professor.card.delete');
        });
        Route::prefix('/users')->group(function (){
            Route::get('/', [AddUserOrganisationController::class, 'getUsers'])->name('professor.users');
            Route::get('/add', [AddUserOrganisationController::class, 'getAddUser'])->name('professor.student.add');;
            Route::post('/add/{userId}', [AddUserOrganisationController::class, 'postAddUser'])->name('professor.student.add.create');
            Route::put('/add/{userId}', [AddUserOrganisationController::class, 'postAddUser'])->name('professor.student.add.create');
            Route::delete('/delete/{userId}', [AddUserOrganisationController::class, 'deleteUser'])->name('professor.student.delete');
        });
    });
});
/**
 * Routes for student
 */
Route::group(['middleware' => 'STU'], function () {

    Route::prefix('student')->group(function (){
        /**
         * Routes for student profile
         */
        Route::prefix('/profile')->group(function (){
            Route::get('/redis', [ProfileController::class, 'redisGetProfile'])->name('student.redis');
            Route::get('/edit', [ProfileController::class, 'getProfileUser'])->name('student.profile');
            Route::post('/edit', [ProfileController::class, 'postProfileStudent'])->name('student.profile.update');
            Route::put('/edit', [ProfileController::class, 'postProfileStudent'])->name('student.profile.update');
        });
        //TODO: Add routes for cards(show,join)
        Route::prefix('/cards')->group(function (){
            Route::get('/', [AddUserCardController::class, 'getCards'])->name('student.cards');
            Route::get('/card/{cardId}', [AddUserCardController::class, 'getCard'])->name('student.card');
            Route::post('/card/{cardId}', [AddUserCardController::class, 'postCard'])->name('student.card.update');
            Route::put('/card/{cardId}', [AddUserCardController::class, 'postCard'])->name('student.card.update');
            Route::get('/join', [AddUserCardController::class, 'getAddCard'])->name('student.card.join');
            Route::post('/join/{cardId}', [AddUserCardController::class, 'postAddCard'])->name('student.card.create');
            Route::put('/join/{cardId}', [AddUserCardController::class, 'postAddCard'])->name('student.card.create');
            Route::delete('/delete/{cardId}', [AddUserCardController::class, 'deleteCard'])->name('student.card.delete');
            Route::get('/validate/{cardId}', [QRCodeController::class, 'generateQRCode'])->name('student.qrcode-generate');
        });
    });
});

Route::group(['middleware' => 'USR'], function () {
    Route::prefix('/user')->group(function () {
        Route::get('/edit', [ProfileController::class, 'getProfileUser'])->name('user.profile');
        Route::post('/edit', [ProfileController::class, 'postProfileStudent'])->name('user.profile.update');
        Route::put('/edit', [ProfileController::class, 'postProfileStudent'])->name('user.profile.update');

        Route::prefix('/organisations')->group(function (){

        });
    });
});

Route::group(['middleware' => 'VEN'], function () {
    Route::prefix('/vendor')->group(function () {
        Route::get('/edit', [ProfileController::class, 'getProfileUser'])->name('vendor.profile');
        Route::post('/edit', [ProfileController::class, 'postProfileStudent'])->name('vendor.profile.update');
        Route::put('/edit', [ProfileController::class, 'postProfileStudent'])->name('vendor.profile.update');

        Route::prefix('/organisations')->group(function (){

        });
    });
});
Route::prefix('/verify')->group(function (){
    Route::get('/card/', [CheckCardController::class, 'verifyCard'])->name('card-check.verify-card');
});


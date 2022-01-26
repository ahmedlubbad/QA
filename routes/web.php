<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\ChangePasswordController;
use App\Http\Controllers\NotificationsController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\RolesController;
use App\Http\Controllers\UserProfileController;
use App\Http\Middleware\Localization;
use Illuminate\Support\Facades\Route;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/
Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath']

],

    function () {
        Route::get('/', function () {
            return view('welcome');
        });

        Route::get('/dashboard', function () {
            return view('dashboard');
        })->middleware(['auth'])->name('dashboard');

        require __DIR__ . '/auth.php';
        require __DIR__ . '/tag.php';
        Route::get('notifications', [NotificationsController::class, 'index'])->middleware('auth')->name('notifications');
        Route::resource('questions', QuestionsController::class);
        Route::resource('roles', RolesController::class)->middleware(['auth', 'user.type:admin,super-admin']);
        Route::get('profile', [UserProfileController::class, 'edit'])->name('profile')->middleware('auth');
        Route::put('profile', [UserProfileController::class, 'update']);
        Route::post('answers', [AnswersController::class, 'store'])->name('answers.store')->middleware('auth');
        Route::put('answers/{id}/best', [AnswersController::class, 'best'])->name('answers.best')->middleware('auth');
        Route::get('password/change', [ChangePasswordController::class, 'create'])->name('password.change')->middleware('auth');
        Route::post('password/change', [ChangePasswordController::class, 'store'])->middleware('auth');

    });

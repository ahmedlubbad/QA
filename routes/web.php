<?php

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\UserProfileController;
use Illuminate\Support\Facades\Route;

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

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth'])->name('dashboard');

require __DIR__ . '/auth.php';
require __DIR__ . '/tag.php';

Route::resource('questions', QuestionsController::class);
Route::get('profile', [UserProfileController::class, 'edit'])->name('profile')->middleware('auth');
Route::put('profile', [UserProfileController::class, 'update']);
Route::post('answers', [AnswersController::class, 'store'])->name('answers.store')->middleware('auth');
Route::put('answers/{id}/best', [AnswersController::class, 'best'])->name('answers.best')->middleware('auth');

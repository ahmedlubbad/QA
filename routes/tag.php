<?php

use App\Http\Controllers\TagsController;
use Illuminate\Support\Facades\Route;

Route::group(['middleware' => ['auth', 'user.type:admin,super-admin'], 'as' => 'tags.'], function () {
    Route::get('/tags', [TagsController::class, 'index'])->name('index');
    Route::get('/tags/create', [TagsController::class, 'create'])->name('create');
    Route::post('/tags', [TagsController::class, 'store'])->name('store');
    Route::get('/tags/{id}/edit', [TagsController::class, 'edit'])->name('edit');
    Route::put('/tags/{id}', [TagsController::class, 'update'])->name('update');
    Route::delete('/tags/{id}', [TagsController::class, 'destroy'])->name('destroy');
});


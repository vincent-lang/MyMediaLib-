<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/photo', [PhotoController::class, 'index'])->name('photo.index');

Route::post('/photo', [PhotoController::class, 'index'])->name('photo.index');

Route::delete('/photo/delete/{photo}', [PhotoController::class, 'delete'])->name('photo.delete');

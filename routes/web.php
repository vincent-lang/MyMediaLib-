<?php

use App\Http\Controllers\PhotoController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
})->name('homepage');

Route::get('/photo', [PhotoController::class, 'index'])->name('photo.index');

Route::post('/photo', [PhotoController::class, 'index'])->name('photo.index');

Route::delete('/photo/delete/{photo}', [PhotoController::class, 'delete'])->name('photo.delete');

// Photo upload form page
Route::get('/photos/upload', [PhotoController::class, 'upload'])->name('photos.upload');

// Form submit page
Route::post('/photos/store', [PhotoController::class, 'store'])->name('photos.store');

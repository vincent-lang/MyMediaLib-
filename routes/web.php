<?php

use App\Http\Controllers\PhotoController;
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
    return view('welcome');
});

// Photo upload form page
Route::get('/photos/upload', [PhotoController::class, 'upload'])->name('photos.upload');

// Form submit page
Route::post('/photos/store', [PhotoController::class, 'store'])->name('photos.store');
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/services', [ServiceController::class, 'index']);

Route::get('/gallery', [GalleryController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', [AuthController::class, 'register']);

Route::post('/register', [AuthController::class, 'store']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::get('/appointments', [BookingController::class, 'history']);

Route::get('/booking/create/{id}', [BookingController::class, 'create']);

Route::post('/booking/store', [BookingController::class, 'store']);

Route::get('/profile', function () {

    return view('profile.index');

});

Route::post('/profile/update', [AuthController::class, 'updateProfile']);
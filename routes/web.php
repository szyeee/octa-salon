
<?php

use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BookingController;

use App\Http\Controllers\HomeController;
use App\Http\Controllers\ServiceController;
use App\Http\Controllers\GalleryController;
use App\Http\Controllers\AboutController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\SlotTimeController;
use App\Http\Controllers\ReservationController;
use App\Http\Controllers\TransactionController;

Route::get('/', [HomeController::class, 'index']);

Route::get('/gallery', [GalleryController::class, 'index']);

Route::get('/about', [AboutController::class, 'index']);

Route::get('/contact', [ContactController::class, 'index']);

Route::get('/login', [AuthController::class, 'login'])->name('login');

Route::post('/login', [AuthController::class, 'authenticate']);

Route::get('/register', [AuthController::class, 'register']);

Route::post('/register', [AuthController::class, 'store']);

Route::post('/logout', [AuthController::class, 'logout']);

Route::middleware('auth')->group(function () {

    Route::get('/home', [HomeController::class, 'index']);

    Route::get('/appointments', [BookingController::class, 'history']);

    Route::get('/booking/create/{id}', [BookingController::class, 'create']);

    Route::post('/booking/store', [BookingController::class, 'store']);

    Route::get('/profile', function () {

        return view('profile.index');

    });

    Route::post('/profile/update', [AuthController::class, 'updateProfile']);
    Route::resource('services', ServiceController::class);

});

Route::get('/forgot-password', [AuthController::class, 'showForgotPasswordForm'])->name('password.request');

Route::post('/forgot-password', [AuthController::class, 'sendResetLinkEmail'])->name('password.email');

Route::get('/reset-password/{token}', [AuthController::class, 'showResetPasswordForm'])->name('password.reset');

Route::post('/reset-password', [AuthController::class, 'resetPassword'])->name('password.update');

// Route untuk admin
Route::middleware(['auth', \App\Http\Middleware\AdminMiddleware::class])->prefix('admin')->name('admin.')->group(function () {

    Route::get('/dashboard', [UserController::class, 'dashboard'])->name('admin.dashboard');
    Route::resource('customers', UserController::class);

    Route::get('services', [ServiceController::class, 'adminIndex'])->name('services.index');
    Route::resource('services', ServiceController::class)->except(['index']);

    Route::get('/reservations', [ReservationController::class, 'index'])->name('reservations.index');
    Route::delete('/reservations/{reservation}', [ReservationController::class, 'destroy'])->name('reservations.destroy');
    Route::patch('/reservations/{id_reservation}/update-status', [ReservationController::class, 'updateStatus'])->name('reservations.updateStatus');

    Route::post('/slot/generate', [SlotTimeController::class, 'generateSlots'])->name('slot.generate');
    Route::get('slot/index', [SlotTimeController::class, 'index'])->name('slot.index');
    Route::resource('slot', SlotTimeController::class)->parameters(['slot' => 'slotTime']);

    Route::get('/pos', [TransactionController::class, 'index'])->name('pos.index');
    Route::post('/pos/pay/{id_reservation}', [TransactionController::class, 'processReservationPayment'])->name('pos.pay');
    
    Route::resource('transactions', TransactionController::class);
});

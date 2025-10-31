<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\LoginController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\ContactController;
use App\Http\Controllers\ScheduleController;
use App\Http\Controllers\BookingController;
use App\Http\Controllers\PaymentController;

Route::get('/register', [RegisterController::class, 'index'])->name('register');
Route::post('/register-user', [RegisterController::class, 'register'])->name('register-user');

Route::get('/login', [loginController::class, 'index'])->name('login');
Route::post('/login-user', [LoginController::class, 'authenticate'])->name('login-user');

Route::get('/logout', function () {
    auth()->logout();
    return redirect('/login');
})->name('logout');

Route::get('/admin', [AdminController::class, 'index'])->middleware(['auth'])->name('admin');
Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/cinema', [CinemaController::class, 'index'])->name('cinema');
Route::get('/contact', [ContactController::class, 'index'])->name('contact');
Route::get('/schedule', [ScheduleController::class, 'index'])->middleware(['auth'])->name('schedule');
Route::post('/booking/store', [BookingController::class, 'store'])->name('booking.store');
Route::get('/booked-seats/{movie_id}', [BookingController::class, 'getBookedSeats']);
Route::post('/payment/store', [PaymentController::class, 'store'])->name('payment.store');





<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\MovieController;
use App\Http\Controllers\CinemaController;
use App\Http\Controllers\ScheduleController;

Route::get('/', [HomeController::class, 'index'])->name('homepage');
Route::get('/movies', [MovieController::class, 'index'])->name('movies');
Route::get('/cinema', [CinemaController::class, 'index'])->name('cinema');
Route::get('/movies/{movie:id}', [MovieController::class, 'edit'])->name('movie.edit');
Route::get('/schedule', [ScheduleController::class, 'index'])->name('schedule');




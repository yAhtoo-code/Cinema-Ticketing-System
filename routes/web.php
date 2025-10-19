<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

Route::get('/', function () {
    return view('movies'); 
})->name('movies');

Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');





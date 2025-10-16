<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

// Movies page (root)
Route::get('/', function () {
    return view('movies'); 
})->name('movies');

// Homepage
Route::get('/homepage', [HomeController::class, 'index'])->name('homepage');




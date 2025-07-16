<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/login-static', function () {
    return view('login-static');
});

// Fallback login route to prevent route('login') errors
Route::get('/login', function () {
    return view('login-static'); // or return a simple message
})->name('login');

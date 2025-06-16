<?php

use App\Http\Controllers\DocumentController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('documents', DocumentController::class);
Route::post('documents/{document}/verify', [DocumentController::class, 'verify'])->name('documents.verify');

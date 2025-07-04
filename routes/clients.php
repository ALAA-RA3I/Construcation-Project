<?php

use App\Http\Controllers\Clients\ClientAuthController;
use Illuminate\Support\Facades\Route;

Route::post('login',[ClientAuthController::class,'login']);

Route::middleware('auth:api-client')->group(function () {
    Route::patch('changePassword/{id}',[ClientAuthController::class,'changePassword']);
});


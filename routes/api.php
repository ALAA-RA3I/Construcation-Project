<?php

use App\Http\Controllers\Api\EngineerController;
use App\Http\Controllers\Api\EngineerSpecializationController;
use App\Http\Controllers\Api\UserController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('specializations')->group(function () {
    Route::get('/', [EngineerSpecializationController::class, 'index']);
//    Route::post('/', [EngineerSpecializationController::class, 'store']);
//    Route::get('/{id}', [EngineerSpecializationController::class, 'show']);
//    Route::put('/{id}', [EngineerSpecializationController::class, 'update']);
//    Route::delete('/{id}', [EngineerSpecializationController::class, 'destroy']);
});

Route::prefix('engineers')->group(function () {
    Route::get('/', [EngineerController::class, 'index']);
//    Route::post('/', [EngineerController::class, 'store']);
//    Route::get('/{id}', [EngineerController::class, 'show']);
//    Route::put('/{id}', [EngineerController::class, 'update']);
//    Route::delete('/{id}', [EngineerController::class, 'destroy']);
});


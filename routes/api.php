<?php

use App\Http\Controllers\Api\ActivationController;
use App\Http\Controllers\Api\ConsultingCompanyController;
use App\Http\Controllers\Api\ConsultingEngineerController;
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
});

///// activation api /////
Route::put('users/activate', [ActivationController::class, 'activate']);
Route::put('users/deactivate', [ActivationController::class, 'deactivate']);
///// activation api /////

Route::prefix('engineers')->group(function () {
    Route::get('/', [EngineerController::class, 'index']);
    Route::get('/all', [EngineerController::class, 'getAll']);
    Route::post('/create', [EngineerController::class, 'create']);
    Route::get('/{id}', [EngineerController::class, 'show']);
    Route::put('update/{id}', [EngineerController::class, 'update']);
    Route::delete('delete/{id}', [EngineerController::class, 'delete']);
});
Route::prefix('consultingEngineers')->group(function () {
    Route::get('/', [ConsultingEngineerController::class, 'index']);
    Route::get('/all', [ConsultingEngineerController::class, 'getAll']);
    Route::post('/create', [ConsultingEngineerController::class, 'create']);
    Route::get('/{id}', [ConsultingEngineerController::class, 'show']);
    Route::put('update/{id}', [ConsultingEngineerController::class, 'update']);
    Route::delete('delete/{id}', [ConsultingEngineerController::class, 'delete']);
});
Route::prefix('consultingCompany')->group(function () {
    Route::get('/all', [ConsultingCompanyController::class, 'getAll']);
    Route::get('/',[ConsultingCompanyController::class, 'index']);
    Route::get('/{id}',[ConsultingCompanyController::class, 'show']);
    Route::post('/create' ,[ConsultingCompanyController::class, 'create']);
    Route::put('update/{id}', [ConsultingCompanyController::class, 'update']);
    Route::delete('delete/{id}', [ConsultingCompanyController::class, 'delete']);
});

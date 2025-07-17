<?php

use App\Http\Controllers\Clients\ClientAuthController;
use App\Http\Controllers\Clients\ClientProjectsController;
use Illuminate\Support\Facades\Route;

Route::post('login',[ClientAuthController::class,'login']);

Route::middleware('auth:api-client')->group(function () {
    Route::patch('changePassword/{id}',[ClientAuthController::class,'changePassword']);
    Route::get('projects', [ClientProjectsController::class, 'getProjects']);
    Route::get('projects/{property_unit}', [ClientProjectsController::class, 'getProjectDetails']);
    Route::get('news', [ClientProjectsController::class, 'getClientProjectsNews']);
    Route::get('bills',[ClientProjectsController::class,'getClientPorjectBills']);
});


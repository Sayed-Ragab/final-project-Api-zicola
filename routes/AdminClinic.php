<?php

use App\Http\Controllers\Api\adminClinic\PatientsController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\PatientController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');



Route::middleware(['auth:sanctum', 'adminclinic'])->group(function () {

    Route::controller(AppointmentController::class)->group(function () {
        Route::get('appointments', 'index');
        Route::post('appointments', 'store');
        Route::PUT('appointments/{id}','update');
        Route::Delete('appointments/{id}', 'destroy');

    });
    Route::controller(PatientsController::class)->group(function () {
    
        Route::post('PatientClinic', 'store');
        Route::PUT('appointments/{id}','update');
        Route::Delete('appointments/{id}', 'destroy');
    });


});


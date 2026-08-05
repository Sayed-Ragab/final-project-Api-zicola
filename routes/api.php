<?php

use App\Http\Controllers\Api\AdminClinicController;
use App\Http\Controllers\Api\AppointmentController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Clinic_Controller;
use App\Http\Controllers\Api\DashboardCalinicController;
use App\Http\Controllers\Api\DoctorsController;
use App\Http\Controllers\Api\PatientController;
use App\Http\Controllers\Api\specializationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::prefix('admin')->group(function () {
    
Route::controller(AuthController::class)->group(function () {

    Route::post('/signup', 'register');
    Route::post('/login', 'login');
});

Route::middleware(['auth:sanctum', 'admin'])->group(function () {

    Route::controller(AuthController::class)->group(function () {

        Route::get('/All-Admin', 'search');
        Route::put('/update-admin/{id}', 'update');
        Route::put('/change_status/{id}', 'changeStatus');
        Route::delete('/Admin-destroy/{id}', 'destroy');
        Route::middleware('auth:sanctum,admin')->group(function () {
            Route::post('/logout', 'logout');
        });
    });

    //==============================================================

    Route::controller(DoctorsController::class)->group(function () {
        Route::post('/create', 'store');
        Route::put('/update/{id}', 'update');
        Route::get('/search-doctors', 'GetDoctors');
        Route::get('/details-doctors/{id}', 'details');
        Route::DELETE('/Doctor-destroy/{id}', 'destroy');
    });

    //==============================================================

    Route::controller(Clinic_Controller::class)->group(function () {
        Route::post("/create-clinic", 'store');
        Route::PUT('/update-clinic/{id}', 'update');
        Route::get('search-by-name', 'search_by_name');
        Route::get('/details-clinic/{id}','details');
        Route::DELETE('delete-clinic/{id}', 'destroy');
    });
    //===============================================================

    Route::controller(PatientController::class)->group(function () {
        Route::post("/create-patients", 'store');
        Route::put('/update-patients/{id}', 'update');
        Route::get('/patients-details/{id}','details');
        Route::get('/search-patient', 'GetPatients');
        Route::DELETE('/destroy/{id}', 'destroy');
    });

    //==========================================================

    Route::controller(AppointmentController::class)->group(function () {
        Route::get('appointments', 'index');
        Route::post('appointments', 'store');
         Route::delete('appointments/{id}', 'destroy');

    
    });

    Route::controller(specializationController::class)->group(function () {
        Route::get('specializations', 'index');
        Route::post('specializations', 'store');
         Route::put('update-specializations/{id}', 'update');
         Route::Delete('destroy-specializations/{id}', 'destroy');
    });


    Route::controller(AdminClinicController::class)->group(function(){
        Route::post('Add-AdminClinic', 'store');
        Route::put('update-AdminClinic/{id}', 'update'); 
         Route::get('/GetAdminClinic', 'GetAdminClinic');
        Route::Delete('Delete-AdminClinic/{id}', 'destroy');   
    });

});
});
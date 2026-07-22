<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\Clinic_Controller;
use App\Http\Controllers\Api\DoctorsController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');




Route::controller(AuthController::class)->group(function(){
Route::post('/signup','register');
Route::post('/login','login');
Route::get('/search','Search_Admin');
Route::put('/update/{id}','update');
Route::put('/change_status/{id}','changeStatus');
Route::delete('/destroy/{id}','destroy');
Route::middleware('auth:sanctum,admin')->group(function() {
Route::post('/logout', 'logout');
    });   
});

Route::controller(DoctorsController::class)->group(function(){
Route::post('/create','store');
Route::put('/update/{id}','update');
Route::get('/search-byname','search_by_name');
Route::get('/search-by-phone','search_by_phone');
Route::DELETE('/destroy/{id}','destroy');
});

Route::controller(Clinic_Controller::class)->group(function(){
Route::post("/create-clinic",'store');
Route::post('/update-clinic/{id}','update');
Route::get('search-by-name','search_by_name');
Route::DELETE('delete-clinic/{id}','destroy');

});
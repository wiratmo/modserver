<?php

use App\Http\Controllers\API\AuthController;
use App\Http\Controllers\API\ConsultationController;
use App\Http\Controllers\API\VaccinationSpotController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::prefix('v1')->group(function () {
    Route::prefix('auth')->group(function () {
        Route::post('/login',[AuthController::class,'login']);
        Route::post('/register',[AuthController::class,'register']);
        Route::group(['middleware' => ['auth:sanctum']], function(){
            Route::post('/logout',[AuthController::class, 'logout']);
        });
    });
    Route::group(['middleware' => ['auth:sanctum']], function(){
        Route::post('/consultations',[ConsultationController::class,'makeconsule']);
        Route::get('/consultations',[ConsultationController::class,'consulecond']);

        Route::get('/spots',[VaccinationSpotController::class,'getVaccineSpot']);
        Route::get('/spots/{id}',[VaccinationSpotController::class,'spotDetail']);
    });

});

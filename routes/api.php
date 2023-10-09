<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::prefix('provinces')->group(function () {
    Route::apiResource('/', App\Http\Controllers\API\ProvinceController::class);
});

Route::prefix('districts')->group(function () {
    Route::apiResource('/', App\Http\Controllers\API\DistrictController::class);
    Route::get('/district/getDistrictByProvice/{id}', 'App\Http\Controllers\API\DistrictController@getDistrictByProvice');
});

Route::prefix('corregimientos')->group(function () {
    Route::apiResource('/', App\Http\Controllers\API\CorregimientoController::class);
    Route::get('/corregimiento/getCorregimientosByDistric/{id}', 'App\Http\Controllers\API\CorregimientoController@getCorregimientosByDistric');
});

Route::prefix('municipality')->group(function () {
    Route::apiResource('/', App\Http\Controllers\API\MunicipalityController::class);
});

Route::prefix('vehicle')->group(function () {
    Route::apiResource('/type', App\Http\Controllers\API\TypeVehicleController::class);
});

Route::prefix('fuel')->group(function () {
    Route::apiResource('/type', App\Http\Controllers\API\FuelTypeController::class);
});

Route::prefix('insurances')->group(function () {
    Route::apiResource('/companies', App\Http\Controllers\API\InsuranceController::class);
});
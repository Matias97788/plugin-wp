<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChilexpressController;
use App\Http\Controllers\StarkenController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

//rutas apis
Route::get('/obtenerregiones', [ChilexpressController::class, 'ObtenerRegiones']);
Route::post('/cotizar', [ChilexpressController::class, 'cotizar']);
Route::get('/obtenertarifasstarken', [StarkenController::class, 'obtenerTarifasStarken']);

Route::get('/obtenervalorenvio', [StarkenController::class, 'obtenerValorEnvio']);





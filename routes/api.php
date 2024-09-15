<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ApiProcedureController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/procedures', [ApiProcedureController::class, 'index']);
Route::post('/procedures', [ApiProcedureController::class, 'store']);


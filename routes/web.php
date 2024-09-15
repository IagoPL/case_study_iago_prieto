<?php

use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::resource('procedures', ProcedureController::class);

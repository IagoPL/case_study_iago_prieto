<?php

use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('procedures.index');
});

Route::resource('procedures', ProcedureController::class);

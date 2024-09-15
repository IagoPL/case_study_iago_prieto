<?php

use App\Http\Controllers\ProcedureController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return redirect()->route('procedures.index');
});

Route::resource('procedures', ProcedureController::class);
Route::get('/procedures/{id}/duplicate', [ProcedureController::class, 'duplicate'])->name('procedures.duplicate');
Route::get('/procedures/{id}', [ProcedureController::class, 'show'])->name('procedures.show');
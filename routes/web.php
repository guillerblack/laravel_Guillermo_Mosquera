<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;


Route::get('mi-sena', [EmpleadoController::class, 'index']);
Route::post('store', [EmpleadoController::class, 'store']);
Route::post('edit', [EmpleadoController::class, 'edit']);
Route::post('delete', [EmpleadoController::class, 'destroy']);

// Otras funciones del nav aquí...

<?php

use App\Http\Controllers\CursoController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\EmpleadoController;
use App\Http\Controllers\EstudianteController;


Route::get('mi-sena', [EmpleadoController::class, 'index']);
Route::post('store', [EmpleadoController::class, 'store']);
Route::post('edit', [EmpleadoController::class, 'edit']);
Route::post('delete', [EmpleadoController::class, 'destroy']);



// rutas para cursos
Route::resource('/cursos',CursoController::class);


<?php

use App\Http\Controllers\AutorController;
use App\Http\Controllers\LibroController;
use Illuminate\Support\Facades\Route;

Route::apiResource('autores', AutorController::class);
Route::apiResource('libros', LibroController::class);

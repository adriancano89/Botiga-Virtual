<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\TallaController;

Route::resources([
    'producto' => ProductoController::class,
    'categoria' => CategoriaController::class,
    'color' => ColorController::class,
    'talla' => TallaController::class
]);


Route::get('/', function () {
    return view('welcome');
});

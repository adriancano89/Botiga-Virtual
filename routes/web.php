<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\TipoProductoController;

Route::resources([
    'producto' => ProductoController::class,
    'categoria' => CategoriaController::class,
    'tipoProducto' => TipoProductoController::class
]);


Route::get('/', function () {
    return view('welcome');
});

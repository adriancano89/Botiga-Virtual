<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;

Route::resources([
    'producto' => ProductoController::class,
    'categoria' => CategoriaController::class
]);


Route::get('/', function () {
    return view('welcome');
});

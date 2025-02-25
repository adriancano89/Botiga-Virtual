<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\UsuarioController;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/usuario/admin', [UsuarioController::class, 'admin'])->name('usuario.admin');

Route::get('/productos', [ProductoController::class, 'obtenerProductos'])->name('productos');

Route::resources([
    'producto' => ProductoController::class,
    'categoria' => CategoriaController::class,
    'color' => ColorController::class,
    'talla' => TallaController::class,
    'tipoProducto' => TipoProductoController::class,
    'usuario' => UsuarioController::class,
    'pedido' => PedidoController::class
]);
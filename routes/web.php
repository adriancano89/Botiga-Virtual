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

Route::post('/fetch-TiposProductos', [TipoProductoController::class, 'obtenerProductos'])->name('tiposProductos.obtenerProductos');

Route::resources([
    'productos' => ProductoController::class,
    'categorias' => CategoriaController::class,
    'colores' => ColorController::class,
    'tallas' => TallaController::class,
    'tiposProductos' => TipoProductoController::class,
    'usuarios' => UsuarioController::class,
    'pedidos' => PedidoController::class
]);
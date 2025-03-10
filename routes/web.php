<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductoController;
use App\Http\Controllers\CategoriaController;
use App\Http\Controllers\ColorController;
use App\Http\Controllers\PedidoController;
use App\Http\Controllers\TallaController;
use App\Http\Controllers\TipoProductoController;
use App\Http\Controllers\UserController;

Route::get('/', [TipoProductoController::class, 'mostrarDestacados'])->name('tiposProductos.destacados');
Route::post('/fetch-TiposProductos', [TipoProductoController::class, 'obtenerProductos'])->name('tiposProductos.obtenerProductos');
Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/usuario/admin', [UserController::class, 'admin'])->name('usuario.admin');

    Route::put('/tiposProductos', [ProductoController::class, 'updateOrCreate'])->name('productos.updateOrCreate');

    Route::resources([
        'productos' => ProductoController::class,
        'categorias' => CategoriaController::class,
        'colores' => ColorController::class,
        'tallas' => TallaController::class,
        'tiposProductos' => TipoProductoController::class,
        'usuarios' => UserController::class,
        'pedidos' => PedidoController::class
    ]);
});

require __DIR__.'/auth.php';

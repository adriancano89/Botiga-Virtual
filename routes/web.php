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
use App\Http\Controllers\CarritoController;
use App\Http\Controllers\CuponController;
use App\Http\Controllers\FotoController;
use App\Http\Controllers\PDFController;

Route::get('/', [TipoProductoController::class, 'mostrarDestacados'])->name('tiposProductos.destacados');
Route::get('/categoria/{categoria}', [CategoriaController::class, 'show'])->name('categoria.show');
Route::get('/categorias/genero/{genero}', [CategoriaController::class, 'mostrarPorGenero'])->name('categorias.mostrarPorGenero');
Route::get('/productos/{id}', [ProductoController::class, 'show'])->name('productos.show');

Route::post('/fetch-TiposProductos', [TipoProductoController::class, 'obtenerProductos'])->name('tiposProductos.obtenerProductos');
Route::post('/fetch-GuardarPersonalizado', [ProductoController::class, 'guardarProductoPersonalizado'])->name('productos.guardarPersonalizado');
Route::post('/fetch-ObtenerStock', [ProductoController::class, 'obtenerStock'])->name('productos.obtenerStock');
Route::post('/fetch-DatosProducto', [ProductoController::class, 'obtenerDatosProducto'])->name('productos.obtenerDatosProducto');
Route::post('/fetch-UsuarioValidado', [UserController::class, 'usuarioValidado'])->name('usuarios.usuarioValidado');
Route::post('/fetch-ObtenerCantidadMaxima', [CarritoController::class, 'cantidadMaxima'])->name('carrito.cantidadMaxima');
Route::delete('/fetch-EliminarImagen/{imagen}', [FotoController::class, 'destroy'])->name('fotos.destroy');
Route::post('/fetch-guardarCupon', [CuponController::class, 'store'])->name('cupones.store');

Route::get('/carrito', [CarritoController::class, 'index'])->name('carrito.index');
Route::post('/carrito/{id}', [CarritoController::class, 'update'])->name('carrito.update');
Route::post('/carrito', [CarritoController::class, 'store'])->name('carrito.store');
Route::delete('/carrito/{id}', [CarritoController::class, 'destroy'])->name('destroy');


Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/usuario/admin', [UserController::class, 'admin'])->name('usuario.admin');

    Route::post('/fetch-cambiarJugado', [UserController::class, 'cambiarJugado'])->name('usuarios.cambiarJugado');

    Route::post('/fetch-comprobarCupon', [CuponController::class, 'comprobarCupon'])->name('cupones.comprobarCupon');

    Route::post('/fetch-obtenerDescuento', [CuponController::class, 'obtenerDescuento'])->name('cupones.obtenerDescuento');

    Route::get('/usuario/misPedidos', [UserController::class, 'misPedidos'])->name('usuario.misPedidos');

    Route::put('/productos/anadirStock', [ProductoController::class, 'updateOrCreate'])->name('productos.updateOrCreate');

    Route::post('/fetch-InsertarCarritoenBD', [CarritoController::class, 'insertarCarritoenBD'])->name('carrito.insertarCarritoenBD');

    Route::get('/imprimirFactura/{id}', [PDFController::class, 'imprimirFactura'])->name('imprimirFactura');

    Route::get('/graficos', [ProductoController::class, 'mostrarGraficos'])->name('productos.mostrarGraficos');
    Route::post('/fetch-graficosVentasMensuales', [ProductoController::class, 'obtenerDatosGraficosVentasMensuales'])->name('productos.obtenerDatosGraficosVentasMensuales');
    Route::post('/fetch-graficos10ProductosMasVendidos', [ProductoController::class, 'obtenerDatosGraficos10ProductosMasVendidos'])->name('productos.obtenerDatosGraficos10ProductosMasVendidos');
    Route::post('/fetch-graficosProductosStockBajo', [ProductoController::class, 'obtenerDatosGraficosProductosStockBajo'])->name('productos.obtenerDatosGraficosProductosStockBajo');

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

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use App\Models\Carrito;
use App\Models\User;
use App\Models\TipoProducto;
use App\Models\Producto;
use App\Models\Talla;
use App\Models\Color;

class CarritoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $id = session('id'); // Obtenemos el id de la sesión
        if(isset($id)) {
            // Obtenemos todos los productos en el carrito del usuario
            $productosEnCarrito = Carrito::with('producto')->where('usuario_id', intval($id))->get();

        } else {
            $productosEnCarrito = [];
        }
        
        $precioTotal = 0;
        foreach ($productosEnCarrito as $productoCarrito) {
            $precioTotal += $productoCarrito->producto->tipoProducto->precio * $productoCarrito->cantidad;
        }
        return view("usuario.carrito", ["productosEnCarrito" => $productosEnCarrito, "precioTotal" => $precioTotal]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $usuario_id = session('id');

        $producto = Producto::where('tipos_producto_id', intval($request->tipos_producto_id))
        ->where('color_id', $request->color_id)
        ->where('talla_id', $request->talla_id)
        ->first();

        $idProductos = $producto->id;
        $stockProducto = $producto->stock;
        $cantidad = $request->cantidad;
        
        if (isset($usuario_id)) {
            $carrito = Carrito::where([
                'usuario_id' => intval($usuario_id),
                'productos_id' => intval($idProductos),
            ])->first();
        
            if ($carrito) {
                $nuevaCantidad = $carrito->cantidad + $cantidad;
                if ($stockProducto >= $nuevaCantidad) {
                    $carrito->update(['cantidad' => $nuevaCantidad]);
                } else {
                    $carrito->update(['cantidad' => $stockProducto]);
                }
            } else {
                Carrito::create([
                    'usuario_id' => $usuario_id,
                    'productos_id' => $producto->id,
                    'cantidad' => $request->cantidad
                ]);
            }
        }
        
        return redirect()->route('productos.show', $request->tipos_producto_id);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $carrito = Carrito::findOrFail($id);
        $carrito->update([
            'cantidad' => $request->cantidad,
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        // Busca el producto en el carrito por su ID
        $producto = Carrito::where('id', $id)->first();

        // Si el producto existe, lo elimina
        if ($producto) {
            $producto->delete();
        }
        
        return redirect()->route('carrito.index');
    }

    public function insertarCarritoenBD(Request $request) {
        $usuario_id = session('id');

        $producto = Producto::where('tipos_producto_id', intval($request->tipos_producto_id))
        ->where('color_id', $request->color_id)
        ->where('talla_id', $request->talla_id)
        ->first();

        $idProductos = $producto->id;
        $stockProducto = $producto->stock;
        $cantidad = $request->cantidad;
        
        $carrito = Carrito::where([
            'usuario_id' => intval($usuario_id),
            'productos_id' => intval($idProductos),
        ])->first();
    
        if ($carrito) {
            $nuevaCantidad = $carrito->cantidad + $cantidad;
            if ($stockProducto >= $nuevaCantidad) {
                $carrito->update(['cantidad' => $nuevaCantidad]);
            } else {
                $carrito->update(['cantidad' => $stockProducto]);
            }
        } else {
            Carrito::create([
                'usuario_id' => $usuario_id,
                'productos_id' => $producto->id,
                'cantidad' => $request->cantidad
            ]);
        }

        $data = [
            "exitoso" => true
        ];

        return response()->json($data);
    }

    public function cantidadMaxima(Request $request) {
        $idProducto = $request->input('id'); // Obtén el id del producto del request
        $producto = Producto::find($idProducto); // Busca el producto por id

        return response()->json([
            'id' => $producto->id,
            'stock' => $producto->stock
        ]);
    }
}

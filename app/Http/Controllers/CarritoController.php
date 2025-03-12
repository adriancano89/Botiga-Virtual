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
            
        }
        // Si no se encuentra, asigna false
        if ($productosEnCarrito == []) {
            $productosEnCarrito = false;
        }



        return view("usuario.carrito", ["productosEnCarrito" => $productosEnCarrito]);
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
        //
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
        //
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
}

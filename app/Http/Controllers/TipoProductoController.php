<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;
use App\Models\Categoria;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.productos.productos');
    }

    public function obtenerProductos() {
        $productos = TipoProducto::paginate(6);
        return response()->json($productos);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $todasCategorias = Categoria::all();
        return view('TiposProductos.crearTipoProducto', compact('todasCategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        TipoProducto::create([
            'categoria_id' => $request->categoria_id, 
            'codigo' => $request->codigo, 
            'foto' => $request->foto, 
            'nombre' => $request->nombre, 
            'precio' => $request->precio, 
            'destacado' => $request->has('destacado'), 
            'descripcion' => $request->descripcion
        ]);
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
        $producto = TipoProducto::find($id);
        $categorias = Categoria::all();
        return view('admin.productos.popupEditar', ["producto" => $producto, "categorias" => $categorias]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = TipoProducto::findOrFail($id);

        $producto->update([
            'categoria_id' => $request->categoria_id, 
            'codigo' => $request->codigo, 
            'foto' => 'foto',
            'nombre' => $request->nombre, 
            'precio' => $request->precio, 
            'destacado' => $request->has('destacado'), 
            'descripcion' => $request->descripcion
        ]);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

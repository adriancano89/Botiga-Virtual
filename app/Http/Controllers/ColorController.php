<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Color;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $ordenar = $request->ordenar;

        $consulta = Color::query();
        if ($busqueda) {
            $consulta->where('nombre', 'like', "%$busqueda%")
                ->orWhere('hexadecimal', 'like', "%$busqueda%");
        }
        
        if ($ordenar) {
            $consulta->orderBy($ordenar, 'asc');
        }
        
        $colores = $consulta->paginate(8);
        return view('admin.colores.colores', ["colores" => $colores]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.colores.crearColores");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Color::create([
            'nombre' => $request->nombre, 'hexadecimal' => $request->hexadecimal
        ]);

        return redirect()->route('colores.index')->with('success', 'Color creado con éxito');
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
        $color = Color::find($id);
        return view('admin.colores.editarColores', ["color" => $color]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $color = Color::findOrFail($id);

        $color->update([
            'nombre' => $request->nombre, 
            'hexadecimal' => $request->hexadecimal
        ]);

        return redirect()->route('colores.index')->with('success', 'Color editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

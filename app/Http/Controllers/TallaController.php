<?php

namespace App\Http\Controllers;

use App\Models\Talla;
use Illuminate\Http\Request;

class TallaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $tallas = Talla::paginate(8);
        return view('admin.tallas.tallas', ["tallas" => $tallas]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.tallas.crearTallas");
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Talla::create([
            'nombre' => $request->nombre
        ]);

        return redirect()->route('tallas.index')->with('success', 'Talla creada con éxito');
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
        $talla = Talla::find($id);
        return view("admin.tallas.editarTalla", ["talla" => $talla]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $talla = Talla::findOrFail($id);

        $talla->update([
            'nombre' => $request->nombre,
        ]);

        return redirect()->route('tallas.index')->with('success', 'Talla editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

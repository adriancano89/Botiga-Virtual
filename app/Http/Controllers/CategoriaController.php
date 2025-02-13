<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        echo "Bienbenido a Categorias";
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('Categorias.crearCategorias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categoria::create([
            'codigo' => $request->codigo, 'nombre' => $request->nombre
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
        //
    }
}

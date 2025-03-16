<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Foto;

class FotoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
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
        $foto = Foto::find($id);
        $mensaje = 'Imagen eliminada con éxito';
        $resultado = true;
        if ($foto) {
            $path = public_path('storage/' . $foto->url);
            if (file_exists($path)) {
                unlink($path);
                Foto::destroy($id);
            }
        }
        else {
            $mensaje = 'Imagen no encontrada';
            $resultado = false;
        }

        $data = [
            "resultado" => $resultado,
            "mensaje" => $mensaje            
        ];

        return response()->json($data);
    }
}

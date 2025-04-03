<?php

namespace App\Http\Controllers;

use App\Models\Cupon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class CuponController extends Controller
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
        $cupon = Cupon::create([
            "codigo" => $request->codigo,
            "descuento" => $request->descuento
        ]);
        $exitoso = false;

        if ($cupon) {
            $exitoso = true;
        }
        
        $data = [
            "exitoso" => $exitoso
        ];
        return response()->json($data);
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

    public function comprobarCupon(Request $request)
    {
        $cupon = Cupon::where('codigo', $request->codigo)->first();
        $valido = false;
        if ($cupon) {
            $valido = true;
        }
        $data = [
            "valido" => $valido
        ];
        return response()->json($data);
    }

    public function obtenerDescuento(Request $request)
    {
        $cupon = Cupon::where('codigo', $request->codigo)->first();
        $descuento = 0;
        if ($cupon) {
            $descuento = $cupon->descuento;
        }
        $data = [
            "descuento" => $descuento
        ];
        return response()->json($data);
    }
}

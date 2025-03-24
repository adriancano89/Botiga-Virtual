<?php

namespace App\Http\Controllers;

use App\Models\Pedido;
use App\Models\ProductoPedido;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $todosUsuarios = User::all();
        return view('admin.usuarios.usuarios', ["todosUsuarios" => $todosUsuarios]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.usuarios.crearUsuario');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {

        User::create([
            'name' => $request->nombre, 
            'apellidos' => $request->apellidos, 
            'password' => Hash::make($request->contrasena),
            'email' => $request->email, 
            'telefono' => $request->telefono, 
            'direcion' => $request->direcion, 
            'rol' => $request->rol
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
        $nuevoRol = $request->rol;
        $usuario = User::find($id);
        $actualizado = $usuario->update([
            "rol" => $nuevoRol
        ]);
        $data = [
            "exitoso" => $actualizado
        ];
        return response()->json($data);
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function admin() {
        return view('Usuarios.admin');
    }

    public function usuarioValidado(Request $request) {
        $validado = (session('id') != null);
        $data = [
            "validado" => $validado
        ];
        return response()->json($data);
    }

    public function misPedidos() {
        $idUsuario = session('id');
        $usuario = User::find($idUsuario);
        $pedidos = $usuario->pedidos()->get();
        
        return view("usuario.misPedidos", ["pedidos" => $pedidos]);
    }
}

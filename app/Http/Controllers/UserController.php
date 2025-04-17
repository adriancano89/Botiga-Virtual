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
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;
        
        $consulta = User::query();
        if ($busqueda) {
            $consulta->where('name', 'like', "%$busqueda%")
                ->orWhere('apellidos', 'like', "%$busqueda%")
                ->orWhere('email', 'like', "%$busqueda%")
                ->orWhere('telefono', 'like', "%$busqueda%");
        }
        
        if ($filtrar && $filtrar != 'todos') {
            $valor = $filtrar == 'clientes' ? false : true;
            $consulta->where('rol', $valor);
        }
        
        if ($ordenar) {
            $consulta->orderBy($ordenar, 'asc');
        }

        $todosUsuarios = $consulta->paginate(8);

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

        return redirect()->route('usuarios.index')->with('success', 'Usuario creado con éxito');
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

    public function cambiarJugado(Request $request) {
        $usuario = User::find(session('id'));

        $exitoso = false;
        
        if ($usuario) {
            $usuario->update([
                "jugado" => true
            ]);
            $exitoso = true;
        }

        $data = [
            "exitoso" => $exitoso
        ];
        return response()->json($data);
    }

    public function misPedidos(Request $request) {
        $idUsuario = session('id');
        $usuario = User::find($idUsuario);

        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;

        $consulta = $usuario->pedidos();

        if ($busqueda) {
            $consulta->where('precio_total', 'like', "%$busqueda%")
                ->orWhere('fecha_venta', 'like', "%$busqueda%")
                ->orWhere('fecha_envio', 'like', "%$busqueda%")
                ->orWhere('fecha_entrega', 'like', "%$busqueda%");
        }
        
        if ($filtrar && $filtrar != 'todos') {
            $valor = $filtrar == 'pendiente' ? false : true;
            $consulta->where('estado', $valor);
        }

        if ($ordenar) {
            if ($ordenar != 'precio_asc' && $ordenar != 'precio_desc') {
                $orden = 'asc';
            }
            else {
                $orden = $ordenar == 'precio_asc' ? 'asc' : 'desc';
                $ordenar = 'precio_total';
            }
            $consulta->orderBy($ordenar, $orden);
        }
        
        $pedidos = $consulta->paginate(8);
        
        return view("usuario.misPedidos", ["pedidos" => $pedidos]);
    }
}

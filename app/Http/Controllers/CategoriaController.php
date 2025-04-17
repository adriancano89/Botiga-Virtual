<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Categoria;
use App\Models\TipoProducto;

class CategoriaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;
        
        $consulta = Categoria::query();

        if ($busqueda) {
            $consulta->where('nombre', 'like', "%$busqueda%")
                ->orWhere('codigo', 'like', "%$busqueda%");
        }
        
        if ($filtrar && $filtrar != 'todos') {
            $consulta->where('nombre', 'like', "%$filtrar%");
        }
        
        if ($ordenar) {
            $consulta->orderBy($ordenar, 'asc');
        }
        
        $categorias = $consulta->paginate(8);
        return view('admin.categorias.categorias', ["categorias" => $categorias]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('admin.categorias.crearCategorias');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        Categoria::create([
            'codigo' => $request->codigo, 'nombre' => $request->nombre
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria creada con éxito');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id, Request $request)
    {
        $categoria = Categoria::find($id);
        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;

        $consulta = TipoProducto::where('categoria_id', $id);
        if ($busqueda) {
            $consulta->where('nombre', 'like', "%$busqueda%");
            if (!$consulta->exists()) {
                $consulta = TipoProducto::where('categoria_id', $id)->where('codigo', 'like', "%$busqueda%");
            }
        }

        if ($filtrar && $filtrar != 'todos') {
            switch ($filtrar) {
                case 'precio_bajo':
                    $consulta->whereBetween('precio', [0, 25]);
                    break;
                case 'precio_medio':
                    $consulta->whereBetween('precio', [26, 50]);
                    break;
                case 'precio_alto':
                    $consulta->where('precio', '>', 50);
            }
        }

        if ($ordenar) {
            if ($ordenar != 'precio_asc' && $ordenar != 'precio_desc') {
                $orden = 'asc';
            }
            else {
                $orden = $ordenar == 'precio_asc' ? 'asc' : 'desc';
                $ordenar = 'precio';
            }
            $consulta->orderBy($ordenar, $orden);
        }

        $productosCategoria = $consulta->paginate(16);
        return view('general.mostrarPorCategorias', ["categoria" => $categoria, "productosCategoria" => $productosCategoria]);
    }
    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $categoria = Categoria::find($id);
        return view('admin.categorias.editarCategoria', ["categoria" => $categoria]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $categoria = Categoria::findOrFail($id);

        $categoria->update([
            'codigo' => $request->codigo,
            'nombre' => $request->nombre
        ]);

        return redirect()->route('categorias.index')->with('success', 'Categoria editada con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function mostrarPorGenero(string $genero, Request $request)
    {
        $genero = ucfirst($genero);

        $busqueda = $request->busqueda;

        $consulta = Categoria::with('tiposProductos')->where('nombre', 'like', "%$genero%");
        if ($busqueda) {
            $consulta->whereHas('tiposProductos', function ($consulta) use ($busqueda) {
                    $consulta->where('nombre', 'like', "%$busqueda%");
                });
    
            if (!$consulta->exists()) {
                $consulta = Categoria::with('tiposProductos')->where('nombre', 'like', "%$genero%")
                    ->whereHas('tiposProductos', function ($consulta) use ($busqueda) {
                        $consulta->where('codigo', 'like', "%$busqueda%");
                    });
            }
        }
        
        $productosCategoria = $consulta->paginate(16);
        
        return view('general.mostrarPorGenero', ["productosCategoria" => $productosCategoria, "genero" => $genero]);
    }
}

<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;
use App\Models\Categoria;
use App\Models\Foto;
use App\Models\User;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.productos.productos');
    }

    public function mostrarDestacados(Request $request)
    {
        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;

        $consulta = TipoProducto::where('destacado', 1)->with('categoria');
        if ($busqueda) {
            $consulta->where('nombre', 'like', "%$busqueda%");

            if (!$consulta->exists()) {
                $consulta = TipoProducto::where('destacado', 1)->with('categoria')->where('codigo', 'like', "%$busqueda%");
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
        
        $productos = $consulta->paginate(8);

        $categorias = Categoria::all();

        $usuario = User::find(session('id'));
        $mostrarJuego = false;
        if ($usuario) {
            $mostrarJuego = !$usuario->jugado;
        }

        return view('principal', ["productos" => $productos, "categorias" => $categorias, "mostrarJuego" => $mostrarJuego]);
    }

    public function obtenerProductos(Request $request) {
        $busqueda = $request->busqueda;
        $filtrar = $request->filtrar;
        $ordenar = $request->ordenar;

        $consulta = TipoProducto::where('nombre', 'like', "%$busqueda%");
        if (!$consulta->exists()) {
            $consulta = TipoProducto::where('codigo', 'like', "%$busqueda%");
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
        
        $productos = $consulta->paginate(8);

        $data = [
            "resultados" => $productos->count() > 0,
            "productos" => $productos
        ];

        return response()->json($data);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $todasCategorias = Categoria::all();
        return view('admin.productos.crearTipoProducto', compact('todasCategorias'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Para que nos se pongan ficheros que no sean imagenes
        if ($request->file('foto')) {
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        }

        if ($request->imagenes_adicionales) {
            $request->validate([
                'imagenes_adicionales.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        }

        // Crear el registro en la base de datos primero
        $tipoProducto = TipoProducto::create([
            'categoria_id' => $request->categoria_id, 
            'codigo' => $request->codigo, 
            'foto' => '', // Vacio porque luego lo agragaremos
            'nombre' => $request->nombre, 
            'precio' => $request->precio, 
            'destacado' => $request->has('destacado'), 
            'descripcion' => $request->descripcion,
            'estado' => $request->has('estado')
        ]);

        if ($request->file('foto')) {
            // Guardamos la imagen en: storage/app/public/fotos/id (producto creado)
            $path = $request->file('foto')->store('fotos/' . $tipoProducto->id, 'public');

            $tipoProducto->update(['foto' => $path]); // path porque es la ruta de la imagen
        }

        if ($request->imagenes_adicionales) {
            foreach ($request->imagenes_adicionales as $imagen) {
                $ruta = $imagen->store('fotos/' . $tipoProducto->id . '/adicionales', 'public');
                Foto::create([
                    'tipos_producto_id' => $tipoProducto->id,
                    'url' => $ruta
                ]);
            }
        }

        return redirect()->route('tiposProductos.index')->with('success', 'Producto creado con éxito');
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
        $imagenes = Foto::where('tipos_producto_id', $id)->get();
        return view('admin.productos.editarProducto', ["producto" => $producto, "categorias" => $categorias, "imagenes" => $imagenes]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $producto = TipoProducto::findOrFail($id);

        if ($request->file('foto')) {
            // Para que nos se pongan ficheros que no sean imagenes
            $request->validate([
                'foto' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        }

        if ($request->imagenes_adicionales) {
            $request->validate([
                'imagenes_adicionales.*' => 'required|image|mimes:jpeg,png,jpg,gif,webp|max:2048',
            ]);
        }

        if ($request->file('foto')) {
            if ($producto->foto) {
                $imagenAntiguaPath = public_path('storage/' . $producto->foto); // Optengo la ruta de la imagen antigua
                if (file_exists($imagenAntiguaPath)) {
                    unlink($imagenAntiguaPath); // Para eliminar la ruta antigua
                }
            }
            // Guardar la nueva imagen en: storage/app/public/fotos/id/adicionales
            $nuevaImagenPath = $request->file('foto')->store('fotos/' . $id, 'public');
        }

        if(isset($nuevaImagenPath)) {
            $path = $nuevaImagenPath;
        } else {
            $path = $producto->foto;
        }
        
        $producto->update([
            'categoria_id' => $request->categoria_id, 
            'codigo' => $request->codigo, 
            'foto' => $path,
            'nombre' => $request->nombre, 
            'precio' => $request->precio, 
            'destacado' => $request->has('destacado'), 
            'descripcion' => $request->descripcion,
            'estado' => $request->has('estado')
        ]);

        if ($request->imagenes_adicionales) {
            foreach ($request->imagenes_adicionales as $imagen) {
                $ruta = $imagen->store('fotos/' . $producto->id . '/adicionales', 'public');
                Foto::create([
                    'tipos_producto_id' => $producto->id,
                    'url' => $ruta
                ]);
            }
        }

        return redirect()->route('tiposProductos.index')->with('success', 'Producto editado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function obtenerCodigoMasAlto(Request $request)
    {

        $registro = TipoProducto::orderByRaw('CAST(SUBSTRING(codigo, 5) AS UNSIGNED) DESC')
            ->first();

        $codigoMasAlto = $registro->codigo;

        $data = [
            "codigo" => $codigoMasAlto
        ];

        return response()->json($data);
    }

    public function comprobarCodigo(Request $request)
    {
        $codigo = $request->codigo;

        $existe = false;
        $mensaje = '';

        $tipoProducto = TipoProducto::where('codigo', $codigo)->first();

        if ($tipoProducto) {
            $existe = true;
            $mensaje = 'El código introducido ya existe. Introduce otro código o haz clic en el botón de generar código para obtener uno recomendado.';
        }

        $data = [
            "existe" => $existe,
            "mensaje" => $mensaje
        ];
        return response()->json($data);
    }
}

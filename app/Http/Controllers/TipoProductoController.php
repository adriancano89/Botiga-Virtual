<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;
use App\Models\Categoria;
use App\Models\Foto;

class TipoProductoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view('admin.productos.productos');
    }

    public function mostrarDestacados()
    {
        $productos = TipoProducto::where('destacado', 1)->with('categoria')->paginate(8);
        $categorias = Categoria::all();
        return view('principal', ["productos" => $productos, "categorias" => $categorias]);
    }

    public function obtenerProductos(Request $request) {
        $productos = TipoProducto::where('nombre', 'like', '%' . $request->busqueda . "%")->paginate(6);

        $productos->count();

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
        return view('admin.productos.popupEditar', ["producto" => $producto, "categorias" => $categorias, "imagenes" => $imagenes]);
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
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

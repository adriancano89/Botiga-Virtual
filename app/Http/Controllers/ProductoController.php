<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TipoProducto;
use App\Models\Talla;
use App\Models\Color;
use App\Models\Foto;
use App\Models\Producto;
use Illuminate\Support\Facades\Storage;

class ProductoController extends Controller
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
        echo "hola";
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $idUsuario = session('id');
        $tipoProducto = TipoProducto::with('categoria')->find($id);
        $producto = Producto::with(['talla', 'color'])->where('tipos_producto_id', $id)->get();
        $tallas = Talla::all();
        $colores = Color::all();
        $imagenes = Foto::where('tipos_producto_id', $id)->get();
        return view("general.producto", 
        ["tipoProducto" => $tipoProducto, 
        "filasStock" => $producto, 
        "tallas" => $tallas, 
        "colores" => $colores, 
        "imagenes" => $imagenes,
        "idUsuario" => $idUsuario]);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $tipoProducto = TipoProducto::find($id);
        $tallas = Talla::all();
        $colores = Color::all();
        return view('admin.productos.editarStock', ["tipoProducto" => $tipoProducto, "tallas" => $tallas, "colores" => $colores]);
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

    public function updateOrCreate(Request $request)
    {
        // Validar los datos del formulario
        /*
        $request->validate([
            'codigo' => 'required|string|max:255',
            'nombre' => 'required|string|max:255',
            'stockAnadir' => 'required|integer|min:1',
            'color_id' => 'required|exists:colores,id',
            'talla_id' => 'required|exists:tallas,id',
        ]);*/

        // Buscar el producto existente
        //dd($request->all());
        
        $productoExistente = Producto::where('tipos_producto_id', intval($request->tipoProducto))
            ->where('color_id', $request->color_id)
            ->where('talla_id', $request->talla_id)
            ->first();

        if ($productoExistente) {
            // Si existe, actualizar el stock
            $productoExistente->stock += $request->stockAnadir;
            $productoExistente->save();
        } else {
            // Si no existe, crear un nuevo producto
            Producto::create([
                'tipos_producto_id' => intval($request->tipoProducto),
                'talla_id' => $request->talla_id,
                'color_id' => $request->color_id,
                'stock' => $request->stockAnadir
            ]);
        }
    }

    public function guardarProductoPersonalizado(Request $request) {
        $dataImagen = $request->input('imagen');
        $idProducto = $request->input('idProducto');
        $imagen = str_replace('data:image/png;base64,', '', $dataImagen); //Quitamos la parte de la información del formato de la imagen
        $imagen = str_replace(' ', '+', $imagen);
        $nombreImagen = time() . '.png'; //Como nombre le ponemos el tiempo actual

        Storage::disk('public')->put('fotos/' . $idProducto . '/personalizadas/' . $nombreImagen, base64_decode($imagen)); //Guardamos la imagen decodificandola antes.
        
        $data = [
            "path" => $nombreImagen
        ];

        return response()->json($data);
    }

    public function obtenerStock(Request $request) {
        $tallaId = $request->input('talla_id');
        $colorId = $request->input('color_id');
    
        // Aquí debes buscar en tu base de datos el stock del producto
        $producto = Producto::where('talla_id', $tallaId)->where('color_id', $colorId)->first();
        
        return response()->json([
            'stock' => $producto ? $producto->stock : 0,
        ]);
    }

    public function obtenerDatosProducto(Request $request) {
        $idTipoProducto = $request->input('idTipoProducto');
        $idTalla = $request->input('idTalla');
        $idColor = $request->input('idColor');
        
        $producto = Producto::with(['tipoProducto', 'talla', 'color'])->where([
            'tipos_producto_id' => intval($idTipoProducto),
            'talla_id' => intval($idTalla),
            'color_id' => intval($idColor)
        ])->get();

        $data = [
            "producto" => $producto
        ];

        return response()->json($data);
    }
}
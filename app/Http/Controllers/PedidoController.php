<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\ProductoPedido;
use App\Models\Producto;
use Illuminate\Http\Request;
use Stripe\Stripe;
use Stripe\Charge;

class PedidoController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $pedidos = Pedido::with('usuario')->get();
        return view("admin.ventas.ventas", ["pedidos" => $pedidos]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $idUsuario = session('id');
        $carrito = Carrito::with('producto')->where('usuario_id', $idUsuario)->get();
        $precioTotal = 0;
        foreach ($carrito as $productoCarrito) {
            $precioTotal += $productoCarrito->producto->tipoProducto->precio * $productoCarrito->cantidad;
        }
        return view("pedidos.pedido", ["productosCarrito" => $carrito, "precioTotal" => $precioTotal]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'stripeToken' => 'required',
            'total' => 'required|numeric' // Asegúrate de que el total esté validado correctamente
        ]);

        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        // Intentamos realizar el cargo a través de Stripe
        $charge = Charge::create([
            'amount' => $request->total * 100, // Convertir a centavos
            'currency' => 'eur',
            'description' => 'Pago en tu tienda online',
            'source' => $request->stripeToken, // Token de Stripe recibido
        ]);
        
        if ($charge) {
            $idUsuario = session('id');
            $carrito = Carrito::with('producto')->where('usuario_id', $idUsuario)->get();
    
            $fecha_venta = date('Y-m-d');
            $fecha_envio = date('Y-m-d', strtotime($fecha_venta . ' +1 day'));
            
            $pedido = Pedido::create([
                "usuario_id" => $idUsuario,
                "precio_total" => $request->precio_total,
                "fecha_venta" => $fecha_venta,
                "fecha_envio" => $fecha_envio,
                "fecha_entrega" => null,
                "estado" => false,
            ]);
    
            foreach ($carrito as $productoCarrito) {
                if ($productoCarrito->producto->stock >= $productoCarrito->cantidad) {
                    ProductoPedido::create([
                        "pedidos_id" => $pedido->id,
                        "productos_id" => $productoCarrito->producto->id,
                        "cantidad" => $productoCarrito->cantidad
                    ]);
    
                    $producto = Producto::findOrFail($productoCarrito->producto->id);
    
                    $producto->update([
                        'stock' => $productoCarrito->producto->stock - $productoCarrito->cantidad,
                    ]);
                } else {
                    ProductoPedido::create([
                        "pedidos_id" => $pedido->id,
                        "productos_id" => $productoCarrito->producto->id,
                        "cantidad" => $productoCarrito->producto->stock
                    ]);
    
                    $producto = Producto::findOrFail($productoCarrito->producto->id);
    
                    $producto->update([
                        'stock' => $productoCarrito->producto->stock - $productoCarrito->producto->stock,
                    ]);
                }
            }
    
            $carritoUsuario = Carrito::where('usuario_id', $idUsuario);
    
            if ($carritoUsuario) {
                $carritoUsuario->delete();
            }
        }
        return view("pedidos.pedidoRealizado", ["idPedido" => $pedido->id]);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $pedido = Pedido::with('productosPedido.producto.tipoProducto')->find($id);

        return view("pedidos.mostrarPedido", ["pedido" => $pedido]);
        //return response()->json($pedido);
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

<?php

namespace App\Http\Controllers;

use App\Models\Carrito;
use App\Models\Pedido;
use App\Models\ProductoPedido;
use App\Models\Producto;
use App\Models\Cupon;
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
        $pedidos = Pedido::with('usuario')->paginate(8);
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
        ]);

        // Configurar Stripe
        Stripe::setApiKey(config('services.stripe.secret'));

        $idUsuario = session('id');

        $carrito = Carrito::with('producto')->where('usuario_id', $idUsuario)->get();

        $precioTotal = 0.0;

        foreach ($carrito as $productoCarrito) {
            $precioTotal += $productoCarrito->producto->tipoProducto->precio * $productoCarrito->cantidad;
        }

        if ($request->cupon) {
            $cupon = Cupon::where('codigo', $request->cupon)->first();
            $descuento = $cupon->descuento;
            $precioTotal -= ($precioTotal * ($descuento / 100)); //Calculamos el precio con el descuento
        }

        $precioTotal += ($precioTotal * 0.21) + 4.99;

        $precioTotal = round($precioTotal, 2);
        
        // Intentamos realizar el cargo a través de Stripe
        $charge = Charge::create([
            'amount' => $precioTotal * 100, // Convertir a centavos
            'currency' => 'eur',
            'description' => 'Pago en tu tienda online',
            'source' => $request->stripeToken, // Token de Stripe recibido
        ]);
        
        if ($charge) {

            $fecha_venta = date('Y-m-d');
            
            $pedido = Pedido::create([
                "usuario_id" => $idUsuario,
                "precio_total" => $precioTotal,
                "fecha_venta" => $fecha_venta,
                "fecha_envio" => null,
                "fecha_entrega" => null,
                "estado" => false,
            ]);

            if ($request->cupon) {
                $cupon = Cupon::where('codigo', $request->cupon)->first();
                Cupon::destroy($cupon->id);
            }
    
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
        $pedido = Pedido::find($id);

        return view("admin.ventas.editarPedido", ["pedido" => $pedido]);
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $pedido = Pedido::find($id);

        if ($request->fecha_envio) {
            $pedido->fecha_envio = $request->fecha_envio;
        }

        $fechaHoy = date('Y-m-d');
        $fechaEntrega = $request->fecha_entrega ? date('Y-m-d', strtotime($request->fecha_entrega)) : null;
        $estadoSeleccionado = $request->estado;

        if ($estadoSeleccionado != $pedido->estado && $estadoSeleccionado == '1') { //Si estaba en pendiente, pero ha seleccionado finalizado
            $pedido->fecha_entrega = $fechaHoy;
            $pedido->estado = true;
        } 
        elseif ($request->fecha_entrega && $fechaEntrega <= $fechaHoy) { //Si se ha seleccionado una fecha de entrega y es el dia de hoy, o un dia pasado.
            $pedido->fecha_entrega = $request->fecha_entrega;
            $pedido->estado = true;
        }
        else {
            $pedido->fecha_entrega = $request->fecha_entrega; //Si se ha seleccionado una fecha de entrega, pero es un dia futuro.
            $pedido->estado = false;
        }
        $pedido->save();

        return redirect()->route('pedidos.index')->with('success', 'Pedido actualizado con éxito');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}

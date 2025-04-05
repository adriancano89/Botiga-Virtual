<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Factura del pedido</title>
    <style>
        body {
            font-family: sans-serif;
        }
        .titulo-fechas, .producto {
            position: relative;
        }
        .titulo-fechas > div {
            position: absolute;
            top: 0;
            right: 0;
        }
        .producto {
            border-bottom: 1px solid black;
        }
        .negrita {
            font-weight: bold;
        }
        td {
            padding: 10px;
        }
        .total_producto {
            position: absolute;
            top: 0;
            right: 0;
        }
        #total {
            position: absolute;
            right: 0;
            margin-top: 10px;
        }
    </style>
</head>
<body>
    <div class="titulo-fechas">
        <h1>Factura del pedido</h1>
        <div>
            <span><span class="negrita">Fecha de la compra:</span> {{ $pedido->fecha_venta }}</span><br>
            <span><span class="negrita">Fecha de envío:</span> {{ $pedido->fecha_envio ? $pedido->fecha_envio : 'Por determinar'}}</span><br>
            <span><span class="negrita">Fecha de entrega:</span> {{ $pedido->fecha_entrega ? $pedido->fecha_entrega : 'Por determinar' }}</span>
        </div>
    </div>
    <section class="productos">
        <h2>Productos:</h2>
    @foreach ($productosPedido as $productoPedido)
        <div class="producto">
            <h3>{{ $productoPedido->producto->tipoProducto->nombre }}</h3>
            <table>
                <tr>
                    <td><span class="negrita">Código:</span> {{ $productoPedido->producto->tipoProducto->codigo }}</td>
                    <td><span class="negrita">Código:</span> {{ $productoPedido->producto->tipoProducto->codigo }}</td>
                    <td><span class="negrita">Categoria:</span> {{ $productoPedido->producto->tipoProducto->categoria->nombre }}</td>
                </tr>
                <tr>
                    <td><span class="negrita">Talla:</span> {{ $productoPedido->producto->talla->nombre }}</td>
                    <td><span class="negrita">Color:</span> {{ $productoPedido->producto->color->nombre }}</td>
                    <td><span class="negrita">Cantidad:</span> {{ $productoPedido->cantidad }}</td>
                </tr>
                <tr>
                    <td><span class="negrita">Precio unidad:</span> {{ $productoPedido->producto->tipoProducto->precio }} €</td>
                </tr>
            </table>
            <span class="total_producto">{{ $productoPedido->producto->tipoProducto->precio * $productoPedido->cantidad }} €</span>
        </div>
    @endforeach
        <span id="total"><span class="negrita">Total:</span> {{$pedido->precio_total}} €</span>
    </section>
</body>
</html>
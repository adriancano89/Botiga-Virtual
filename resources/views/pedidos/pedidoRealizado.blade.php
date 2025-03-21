<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Pedido realizado</title>
</head>
<body>
    <h3>El pedido se ha realizado con éxito.</h3>
    <a href="{{route('imprimirFactura', $idPedido)}}"><button>Ver factura del pedido</button></a>
</body>
</html>
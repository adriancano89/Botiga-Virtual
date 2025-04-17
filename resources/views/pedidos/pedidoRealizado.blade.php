<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css'])
    <title>Pedido realizado</title>
</head>
<body>
    @include('general.header')
    <div class="flex items-center justify-center min-h-[50vh] bg-gray-300">
        <div class="bg-white p-10 rounded-lg shadow-lg shadow-slate-400 text-center max-w-md w-full border border-gray-300">
            <h1 class="text-2xl font-bold text-gray-800 mb-4">¡Pedido realizado con éxito!</h1>
            <p class="text-gray-600 mb-6">Puedes ver la factura a continuación.</p>
            <div class="flex flex-col gap-3 items-center">
                <a href="{{ route('imprimirFactura', $idPedido) }}">
                    <button class="bg-green-500 hover:bg-green-600 text-white font-semibold py-2 px-4 rounded-md w-full">
                        Ver factura del pedido
                    </button>
                </a>
                <a href="{{route('usuario.misPedidos')}}">
                    <button class="bg-gray-300 hover:bg-gray-400 text-gray-800 font-semibold py-2 px-4 rounded-md w-full">
                        Ver mis pedidos
                    </button>
                </a>
            </div>
        </div>
    </div>
    @include('general.footer')
</body>
</html>

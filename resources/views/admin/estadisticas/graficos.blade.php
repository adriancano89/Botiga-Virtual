<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar | Gráficos</title>
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/productos/graficos.js') }}" defer></script>
</head>
<body>
    @include('general.header')
        <div class="flex flex-row">
            @include('usuario.barraLateral')
            <section class="seccion-principal">
                <section class="cabecera-contenido">
                    <h1>Gráficos</h1>
                </section>
                <div>
                    <h2 class="text-xl font-bold ml-3">Ventas Mensuales</h2>
                    <canvas id="ventasMensuales" width="1200" height="600"></canvas>
                    <legend for="ventasMensuales"></legend>
                </div>

                <div>
                    <h2 class="text-xl font-bold ml-3">10 Productos Más Vendidos</h2>
                    <canvas id="productos10MasVendidos" width="1200" height="600"></canvas>
                </div>

                <div>
                    <h2 class="text-xl font-bold ml-3">Productos con Stock Bajo</h2>
                    <canvas id="productosStockBajo" width="1200" height="600"></canvas>
                </div>
            </section>
        </div>
    @include('general.footer')
</body>
</html>
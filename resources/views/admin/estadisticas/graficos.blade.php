<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <title>Administrar | Graficos</title>
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/productos/graficos.js') }}" defer></script>
</head>
<body>
    @include('general.header')
        <div class="flex flex-row">
            @include('usuario.barraLateral')
            <section class="w-[85%] p-4">
                <h1>Gráficos</h1>
                <div>
                    <h2>Ventas Mensuales</h2>
                    <canvas id="ventasMensuales" width="1200" height="600"></canvas>
                    <legend for="ventasMensuales"></legend>
                </div>

                <div>
                    <h2>10 Productos Más Vendidos</h2>
                    <canvas id="productos10MasVendidos" width="1200" height="600"></canvas>
                </div>

                <div>
                    <h2>Productos con Stock Bajo</h2>
                    <canvas id="productosStockBajo" width="1200" height="600"></canvas>
                </div>
            </section>
        </div>
    @include('general.footer')
</body>
</html>
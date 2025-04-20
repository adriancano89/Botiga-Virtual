<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Editar Stock Producto</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Añadir stock</h1>
            </section>
            <section class="contenido">
                <form action="{{ route('productos.updateOrCreate') }}" method="POST" enctype="multipart/form-data" class="formulario">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="codigo" class="label">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ $tipoProducto->codigo }}" readonly class="input borde-cuaternario bg-gray-100">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $tipoProducto->nombre }}" readonly class="input borde-cuaternario bg-gray-100">
                        </div>

                        <div class="w-full hidden">
                            <input type="text" name="tipoProducto" id="tipoProducto" value="{{ $tipoProducto->id }}" readonly>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="stock" class="label">Stock actual</label>
                            <input type="text" name="stock" id="stock" value="X" readonly class="input borde-cuaternario bg-gray-100">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="color_id" class="label">Color</label>
                            <select name="color_id" id="color_id" class="input borde-cuaternario" required>
                                <option value="" disabled selected>-- Seleccionar --</option>
                                @foreach($colores as $color)
                                    <option value="{{ $color->id }}" style="background-color: {{ $color->hexadecimal }};">{{ $color->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="talla_id" class="label">Talla</label>
                            <select name="talla_id" id="talla_id" class="input borde-cuaternario" required>
                                <option value="" disabled selected>-- Seleccionar --</option>
                                @foreach($tallas as $talla)
                                    <option value="{{ $talla->id }}">{{ $talla->nombre }}</option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="stockAnadir" class="label">Stock a añadir</label>
                            <input type="number" name="stockAnadir" id="stockAnadir" class="input borde-cuaternario" min="1" required>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="btn-enviar fondo-secundario">Añadir</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>
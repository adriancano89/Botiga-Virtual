<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/colores/validarForms.js') }}" defer></script>
    <title>Administrar - Editar Color</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Editar color</h1>
            </section>
            <section class="contenido">
                <form action="{{ route('colores.update', $color->id) }}" method="POST" enctype="multipart/form-data" class="formulario">
                    @csrf
                    @method('PUT')

                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $color->nombre }}" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="hexadecimal" class="label">Hexadecimal</label>
                            <input type="color" name="hexadecimal" id="hexadecimal" value="{{ $color->hexadecimal }}" class="input borde-cuaternario p-1 h-12" required>
                        </div>
                    </div>

                    <div class="flex justify-center mt-6">
                        <button type="submit" class="btn-enviar fondo-secundario">Editar</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>
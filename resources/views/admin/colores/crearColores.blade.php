<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar - Crear color</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Crear color</h1>
            </section>
            <section class="contenido">
                <form action="{{route('colores.store')}}" method="POST" class="formulario">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="input borde-cuaternario">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="hexadecimal" class="label">Hexadecimal</label>
                            <input type="color" name="hexadecimal" id="hexadecimal" class="input borde-cuaternario p-1 h-12">
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6">
                        <button type="submit" class="btn-enviar fondo-secundario">Crear</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>
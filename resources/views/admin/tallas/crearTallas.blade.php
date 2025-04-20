<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/tallas/validarForms.js') }}" defer></script>
    <title>Administrar - Crear talla</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Crear talla</h1>
            </section>
            <section class="contenido">
                <form action="{{route('tallas.store')}}" method="POST" class="formulario">
                    @csrf
                    <div class="flex flex-col mb-6">
                        <label for="nombre" class="label">Nombre</label>
                        <input type="text" name="nombre" id="nombre" class="input borde-cuaternario" maxlength="10" required>
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
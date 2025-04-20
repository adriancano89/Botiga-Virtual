<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/categorias/validarForms.js') }}" defer></script>
    <title>Administrar - Crear Categoria</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Crear categoria</h1>
            </section>
            <section class="contenido">
                <form action="{{route('categorias.store')}}" method="POST" class="formulario" id="formCrear">
                    @csrf
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="codigo" class="label">Código</label>
                            <input type="text" name="codigo" id="codigo" class="input borde-cuaternario" required>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" class="input borde-cuaternario" required>
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6">
                        <button type="submit" class="btn-enviar fondo-secundario">Crear</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('popups.popupErroresFormulario')
    @include('general.footer')
</body>
</html>
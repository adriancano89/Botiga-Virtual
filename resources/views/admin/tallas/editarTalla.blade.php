<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar - Editar Talla</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Editar talla</h1>
            </section>
            <section class="contenido">
                <form action="{{ route('tallas.update', $talla->id) }}" method="POST" class="formulario">
                    @csrf
                    @method('PUT')

                    <div class="flex justify-center mb-6">
                        <div class="flex flex-col w-full max-w-md">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $talla->nombre }}" class="input borde-cuaternario">
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
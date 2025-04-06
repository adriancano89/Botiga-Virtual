<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <title>Administrar - Editar Categoria</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Editar categoría</h1>
            </section>
            <section class="contenido">
                <form action="{{ route('categorias.update', $categoria->id) }}" method="POST" enctype="multipart/form-data" class="formulario">
                    @csrf
                    @method('PUT')
                    
                    <div class="grid grid-cols-1 sm:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="codigo" class="label">Código</label>
                            <input type="text" name="codigo" id="codigo" value="{{ $categoria->codigo }}" class="input borde-cuaternario">
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $categoria->nombre }}" class="input borde-cuaternario">
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6 w-full">
                        <button type="submit" class="btn-enviar fondo-secundario">Editar</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('general.footer')
</body>
</html>
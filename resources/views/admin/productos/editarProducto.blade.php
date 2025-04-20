<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css', 'resources/css/estilosAdmin.css'])
    <script src="{{ asset('js/fetch.js') }}" defer></script>
    <script src="{{ asset('js/validaciones.js') }}" defer></script>
    <script src="{{ asset('js/productos/validarForms.js') }}" defer></script>
    <script src="{{ asset('js/productos/eliminarImagenesAdicionales.js') }}" defer></script>
    <title>Administrar - Editar Producto</title>
</head>
<body>
    @include('general.header')
    <div class="flex flex-row">
        @include('usuario.barraLateral')
        <section class="seccion-principal">
            <section class="cabecera-contenido">
                <h1>Editar producto</h1>
            </section>
            <section class="contenido">
                <form action="{{ route('tiposProductos.update', $producto->id) }}" method="POST" enctype="multipart/form-data" class="formulario" id="formEditar">
                    @csrf
                    @method('PUT')
                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-6">
                        <div class="flex flex-col w-full">
                            <label for="codigo" class="label">Código</label>
                            <div class="flex flex-row gap-4">
                                <input type="text" name="codigo" id="codigo" value="{{ $producto->codigo }}" class="input borde-cuaternario w-full" maxlength="7" required>
                                <img src="{{ asset('icons/general/actualizar-flecha.png') }}" alt="Sugerir código" class="w-11 hover:cursor-pointer" title="Sugerir código" id="iconoSugerirCodigo">
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="nombre" class="label">Nombre</label>
                            <input type="text" name="nombre" id="nombre" value="{{ $producto->nombre }}" class="input borde-cuaternario" required>
                        </div>

                        <div class="col-span-1 md:col-span-2">
                            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 items-start">
                                <div class="flex flex-col items-center w-full">
                                    <p class="label mb-2 text-center">Fotografía actual del producto</p>
                                    @if($producto->foto)
                                        <img src="{{ asset('storage/' . $producto->foto) }}" alt="Imagen actual del producto" class="w-40 h-40 object-cover rounded shadow">
                                    @else
                                        <p class="text-sm text-gray-500 text-center">No hay imagen actual disponible</p>
                                    @endif
                                </div>

                                <div class="flex flex-col w-full">
                                    <label for="foto" class="label">Subir nueva fotografía</label>
                                    <input type="file" name="foto" id="foto" accept="image/*" class="input borde-cuaternario">
                                </div>
                            </div>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="categoria_id" class="label">Categoría</label>
                            <select name="categoria_id" id="categoria_id" class="input borde-cuaternario" required>
                                @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" {{ $categoria->id == $producto->categoria_id ? 'selected' : '' }}>
                                        {{ $categoria->nombre }}
                                    </option>
                                @endforeach
                            </select>
                        </div>

                        <div class="flex flex-col w-full">
                            <label for="precio" class="label">Precio</label>
                            <input type="number" name="precio" id="precio" value="{{ $producto->precio }}" class="input borde-cuaternario" step="0.01" min="0" max="200" required>
                        </div>

                        <div class="flex flex-col w-full md:col-span-2">
                            <label for="descripcion" class="label">Descripción</label>
                            <textarea name="descripcion" id="descripcion" class="input borde-cuaternario w-full h-32" maxlength="255">{{ $producto->descripcion }}</textarea>
                        </div>

                        <div class="flex flex-row gap-4 items-center w-full">
                            <label for="destacado" class="label">Destacado</label>
                            <input type="checkbox" name="destacado" id="destacado" value="1" class="checkbox" {{ $producto->destacado ? 'checked' : '' }}>
                        </div>

                        <div class="flex flex-row items-center gap-4 w-full">
                            <label for="estado" class="label">Activo</label>
                            <input type="checkbox" name="estado" id="estado" value="1" class="checkbox" {{ $producto->estado ? 'checked' : '' }}>
                        </div>

                        <div class="flex flex-col w-full md:col-span-2">
                            <label class="label mb-2">Imágenes adicionales actuales</label>
                            <div class="grid grid-cols-2 md:grid-cols-4 gap-4 mb-4">
                                @foreach ($imagenes as $imagen)
                                    <div class="relative">
                                        <img src="{{ asset('storage/' . $imagen->url) }}" alt="Imagen adicional" class="w-full object-cover rounded shadow">
                                        <img src="{{ asset('icons/general/papelera.png') }}"
                                            alt="Eliminar imagen"
                                            class="w-6 h-6 absolute top-1 right-1 cursor-pointer icono-eliminar"
                                            id="{{ $imagen->id }}"
                                            title="Eliminar imagen adicional">
                                    </div>
                                @endforeach
                            </div>

                            <label for="imagenes_adicionales" class="label">Subir nuevas imágenes adicionales</label>
                            <input type="file" name="imagenes_adicionales[]" id="imagenes_adicionales" multiple accept="image/*" class="input borde-cuaternario">
                        </div>
                    </div>

                    <div class="flex flex-row justify-center mt-6 w-full">
                        <button type="submit" class="btn-enviar fondo-secundario">Editar</button>
                    </div>
                </form>
            </section>
        </section>
    </div>
    @include('popups.popupErroresFormulario')
    @include('general.footer')
</body>
</html>
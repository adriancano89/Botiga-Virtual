<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @vite(['resources/css/app.css'])
    <script src="{{ asset('js/productos/canvas.js') }}" defer></script>
    <title>{{$tipoProducto->nombre}} - Sundero Sweatshirt</title>
</head>
<body>
    @include('general.header')
    <section class="relative">
        <div class="flex flex-row">
            <div>
                @if($tipoProducto->foto)
                    <img src="{{ asset('storage/' . $tipoProducto->foto) }}" alt="Imagen del producto" id="imagenSudadera">
                @else
                    <span>No hay imagen disponible</span>
                @endif
            </div>
            <div class="flex flex-col p-4">
                <div class="flex flex-col">
                    <h1 class="titulo-apartado">{{$tipoProducto->nombre}}</h1>
                    <span class="categoria">{{$tipoProducto->categoria->nombre}}</span>
                    <span class="categoria">{{$tipoProducto->codigo}}</span>
                    <span>{{$tipoProducto->precio}} €</span>
                </div>
                <div class="mt-8">
                    <div>
                        <label for="talla">Talla</label>
                        <select name="talla_id" id="talla_id">
                            <option value="" disabled selected>-- Seleccionar --</option>
                            @foreach ($tallas as $talla)
                                @php
                                    $coincidencia = false;
                                @endphp
                                @foreach ($filasStock as $producto)
                                    @if($producto->talla->nombre == $talla->nombre)
                                        @php
                                            $coincidencia = true;
                                        @endphp
                                    @endif
                                @endforeach
                                <option value="{{$talla->id}}" {{$coincidencia ? '' : 'disabled'}}>{{$talla->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="color">Color</label>
                        <select name="color_id" id="color_id">
                            <option value="" disabled selected>-- Seleccionar --</option>
                            @foreach ($colores as $color)
                                @php
                                    $coincidencia = false;
                                @endphp
                                @foreach ($filasStock as $producto)
                                    @if($producto->color->nombre == $color->nombre)
                                        @php
                                            $coincidencia = true;
                                        @endphp
                                    @endif
                                @endforeach
                                <option value="{{$color->id}}" {{$coincidencia ? '' : 'disabled'}}>{{$color->nombre}}</option>
                            @endforeach
                        </select>
                    </div>
                    <div>
                        <label for="cantidad">Cantidad:</label>
                        <select name="cantidad" id="cantidad">
                            
                        </select>
                    </div>
                </div>
                <div>
                    <span>Imágenes:</span>
                    <div>
                    @foreach ($imagenes as $imagen)
                        <img src="{{$imagen->url}}" alt="imagen sudadera">
                    @endforeach
                    </div>
                </div>
            </div>
        </div>

        <div>
            <h1>Descripción</h1>
            <p>
                {{$tipoProducto->descripcion}}
            </p>
        </div>

        @if($tipoProducto->foto)
        <div>
            <h1>Personalizar producto</h1>
            <div class="w-fit">
                <div>
                    <canvas id="canvas"></canvas>
                </div>
                <div>
                    <div>
                        <label for="color">Color:</label>
                        <input type="color" name="color" id="color">
                    </div>
                    <div>
                        <label for="grosor">Grosor:</label>
                        <input type="range" name="grosor" id="grosor" min="1" max="20">
                        <span id="valorGrosor"></span>
                    </div>
                    <div class="flex flex-row justify-between">
                        <button class="border border-black p-2" id="limpiar">Borrar</button>
                        <button id="guardar">Guardar</button>
                    </div>
                </div>
            </div>
        </div>
        @endif

        <nav class="absolute top-1/2 right-[5%] flex flex-col">
            <button>Añadir al carrito</button>
            <button>Comprar ahora</button>
        </nav>
    </section>
    @include('general.footer')
</body>
</html>
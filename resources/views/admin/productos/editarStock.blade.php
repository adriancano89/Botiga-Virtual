<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Stock Producto</title>
</head>
<body>
    <form action="{{route('productos.updateOrCreate')}}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')
        <div class="flex flex-row flex-wrap">
            <div>
                <label for="codigo">Código</label>
                <input type="text" name="codigo" id="codigo" value="{{$tipoProducto->codigo}}" readonly>
            </div>
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{$tipoProducto->nombre}}" readonly>
            </div>
            <div>
                <input type="text" name="tipoProducto" id="tipoProducto" value="{{$tipoProducto->id}}" readonly>
            </div>
            <div>
                <label for="stock">Stock</label>
                <input type="text" name="stock" id="stock" value="X" readonly>
            </div>
            <div>
                <label for="color">Color</label>
                <select name="color_id" id="color_id">
                    <option value="" disabled selected>-- Seleccionar --</option>
                @foreach($colores as $color)
                    <option value="{{$color->id}}" style="background-color: {{$color->hexadecimal}};">{{$color->nombre}}</option>
                @endforeach
                </select>
            </div>
            <div>
                <label for="talla">Talla</label>
                <select name="talla_id" id="talla_id">
                    <option value="" disabled selected>-- Seleccionar --</option>
                @foreach($tallas as $talla)
                    <option value="{{$talla->id}}">{{$talla->nombre}}</option>
                @endforeach
                </select>
            </div>
            <div>
                <label for="stockAnadir">Stock a Añadir</label>
                <input type="text" name="stockAnadir" id="stockAnadir">
            </div>
        </div>
        <input type="submit" value="Añadir">
    </form>
</body>
</html>
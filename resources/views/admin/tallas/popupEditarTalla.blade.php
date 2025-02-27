<div class="flex flex-col">
    <div class="flex flex-row justify-between">
        <h1>Editar talla</h1>
    </div>
    <form action="{{route('tallas.update', $talla->id)}}" method="POST">
        @csrf
        @method('PUT')
        <div class="flex flex-col">
            <div>
                <label for="nombre">Nombre</label>
                <input type="text" name="nombre" id="nombre" value="{{$talla->nombre}}">
            </div>
            <input type="submit" value="Editar">
        </div>
    </form>
    
</div>
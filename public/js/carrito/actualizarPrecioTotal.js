const spanSubtotal = document.getElementById('subtotal');
const spanIva = document.getElementById('iva');
const spanTotal = document.getElementById('total');
const selectsCantidades = document.querySelectorAll('.cantidades');
const carritoBD = document.getElementById('tablaCarrito');
const carritoLS = document.getElementById('tablaCarritoLS');

function actualizarPreciosDOM(subtotal) {
    if (subtotal > 0) {
        spanSubtotal.innerHTML = subtotal.toFixed(2) + ' €';
    
        let iva = subtotal * 0.21;
        spanIva.innerHTML = iva.toFixed(2) + ' €';

        spanTotal.innerHTML = (subtotal + iva + 4.99).toFixed(2) + ' €';
    }
    else {
        spanSubtotal.innerHTML = '0.00 €';
        spanIva.innerHTML = '0.00 €';
        spanTotal.innerHTML = '0.00 €';
    }
}

function restarYSumarPrecioCarrito(precioUnidad, cantidadAnterior, nuevaCantidad) {
    console.log("Precio unidad: " + precioUnidad);
    console.log("Cantidad anterior: " + cantidadAnterior);
    console.log("Nueva cantidad: " + nuevaCantidad);

    let subtotal = Number(spanSubtotal.textContent.slice(0, -1));
    subtotal -= precioUnidad * cantidadAnterior;
    subtotal += precioUnidad * nuevaCantidad;
    
    actualizarPreciosDOM(subtotal);
}

function actualizarPrecioTotal(cantidadInicial, cantidadActual, idSelect) {
    const divPadre = document.querySelector('#datosProducto-' + idSelect);
    const divPrecioUnitario = divPadre.querySelector('.precio-unidad');
    const divPrecioTotal = divPadre.querySelector('.precio-total');
    let precioUnitario = Number(divPrecioUnitario.textContent.slice(0, -1));
    let nuevaCantidad = Number(cantidadActual);
    console.log('Cantidad seleccionada:' + nuevaCantidad);
    restarYSumarPrecioCarrito(precioUnitario, cantidadInicial, nuevaCantidad);
    divPrecioTotal.innerHTML = (precioUnitario * nuevaCantidad).toFixed(2) + ' €';
}

if (carritoBD) { //Comprobamos si se ha cargado la tabla del carrito guardado en la base de datos
    if (carritoBD.children.length === 0) {
        carritoBD.innerHTML = '<span>No hay productos en el carrito.</span>';
    }
}
else {
    spanTotal.innerHTML = '0.00 €';
}
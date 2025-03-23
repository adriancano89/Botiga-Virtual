const canvas = document.getElementById('canvas');
const inputColor = document.getElementById('color');
const inputGrosor = document.getElementById('grosor');
const spanGrosor = document.getElementById('valorGrosor');
const btnLimpiar = document.getElementById('limpiar');
const btnGuardar = document.getElementById('guardar');
const imagenSudadera = document.getElementById('imagenSudadera');

let dibujando = false;
let inicioX, inicioY, finX, finY;

function cargarImagenEnCanvas(context) {
    const imagen = new Image();
    imagen.src = imagenSudadera.src;
    imagen.onload = function() {
        context.drawImage(imagen, 0, 0, canvas.width, canvas.height);
    }
}

function empezarDibujar(event) {
    dibujando = true;
    inicioX = event.offsetX;
    inicioY = event.offsetY;
    finX = event.offsetX;
    finY = event.offsetY;
}

function dibujar(event, context) {
    if (dibujando) {
        console.log(event.offsetX, event.offsetY);

        context.beginPath();
        context.moveTo(finX, finY); //Indicamos que el trazo va a ser en las últimas coordenadas.
        context.lineTo(event.offsetX, event.offsetY); //Dibujamos una línea entre las últimas coordenadas y las nuevas.
        context.strokeStyle = inputColor.value;
        context.lineWidth = inputGrosor.value;
        context.stroke();
        
        finX = event.offsetX;
        finY = event.offsetY;
    }

}

function pararDibujar(event) {
    dibujando = false;
}

async function guardarImagenServidor() {
    const dataImagen = canvas.toDataURL('image/png');
    console.log("Imagen: " + dataImagen);
    const url = window.location.href;
    const arrayURL = url.split('/');
    const idProducto = Number(arrayURL[arrayURL.length - 1]);
    console.log("Id producto: " + idProducto);

    let dataEnvio = {
        "imagen" : dataImagen,
        "idProducto" : idProducto
    };
    let data = await enviarDatos('/fetch-GuardarPersonalizado', dataEnvio, 'POST', 'Error al guardar el producto personalizado');
    console.log(data);
}

if (canvas) { //Comprobamos que haya la etiqueta canvas en el DOM
    spanGrosor.textContent = inputGrosor.value;

    const context = canvas.getContext('2d');

    canvas.width = 400;
    canvas.height = 400;

    cargarImagenEnCanvas(context);

    inputGrosor.addEventListener('input', function() {
        spanGrosor.textContent = inputGrosor.value;
    });

    btnLimpiar.addEventListener('click', function() {
        context.clearRect(0, 0, canvas.clientWidth, canvas.height);
        cargarImagenEnCanvas(context);
    });

    btnGuardar.addEventListener('click', function() {
        guardarImagenServidor();
    });

    canvas.addEventListener('mousedown', empezarDibujar);
    canvas.addEventListener('mousemove', function(event) {
        dibujar(event, context);
    });
    canvas.addEventListener('mouseup', pararDibujar);
    canvas.addEventListener('mouseleave', pararDibujar);
}
const iconos = document.querySelectorAll('.icono-eliminar');

iconos.forEach(icono => {
    icono.addEventListener('click', async function() {
        const idImagen = icono.id;
        let respuesta = await recibirDatos('/fetch-EliminarImagen/' + idImagen, 'DELETE', 'Error al eliminar la imagen adicional');
        console.log(respuesta);
        
        if (respuesta.resultado) {
            let divImagen = icono.parentElement; // Obtenemos el div que contiene la imagen
            let divPadre = divImagen.parentElement; // Obtenemos el div padre del div que contiene la imagen
            divPadre.removeChild(divImagen);
        }
    });
});
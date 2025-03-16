const iconos = document.querySelectorAll('.icono-eliminar');
const token = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

async function eliminarImagen(idImagen) {
    let data;
    try {
        const promesa = await fetch('/fetch-EliminarImagen/' + idImagen, {
        method: 'DELETE',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': token
        }
        });

        if (!promesa.ok) {
            throw new Error('Error al eliminar la imagen adicional');
        }

        data = await promesa.json();
        console.log(data);
    }
    catch (error) {
        console.error(error);
    }
    return data;
}

iconos.forEach(icono => {
    icono.addEventListener('click', async function() {
        const idImagen = icono.id;
        let respuesta = await eliminarImagen(idImagen);

        if (respuesta.resultado) {
            let divImagen = icono.parentElement; // Obtenemos el div que contiene la imagen
            let divPadre = divImagen.parentElement; // Obtenemos el div padre del div que contiene la imagen
            divPadre.removeChild(divImagen);
        }
    });
});
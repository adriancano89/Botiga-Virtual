async function enviarDatos(url, datos, metodo, mensajeError) {
    let data;
    try {
        const promesa = await fetch(url, {
        method: metodo,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        },
        body : JSON.stringify(datos)
        });

        if (!promesa.ok) {
            throw new Error(mensajeError);
        }

        data = await promesa.json();
    }
    catch (error) {
        console.error(error);
    }
    return data;
}

async function recibirDatos(url, metodo, mensajeError) {
    let data;
    try {
        const promesa = await fetch(url, {
        method: metodo,
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
        });

        if (!promesa.ok) {
            throw new Error(mensajeError);
        }

        data = await promesa.json();
    }
    catch (error) {
        console.error(error);
    }
    return data;
}

async function consultarUsuarioValidado() {
    let data;
    try {
        const promesa = await fetch('/fetch-UsuarioValidado', {
        method: 'POST',
        headers: {
            'Content-Type': 'application/json',
            'X-CSRF-TOKEN': document.querySelector('meta[name="csrf-token"]').getAttribute('content'),
        }
        });

        if (!promesa.ok) {
            throw new Error('Error al comprobar si el usuario está validado');
        }

        data = await promesa.json();
        console.log(data);
    }
    catch (error) {
        console.error(error);
    }
    return data.validado;
}
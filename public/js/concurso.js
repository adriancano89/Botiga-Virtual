const divConcurso = document.getElementById('concurso');
const infoJuego = document.getElementById('infoJuego');
const btnJugar = document.getElementById('jugar');

let nivel = 1;
let fallos = 0;
let fallado = true;

const premios = ["descuento del 30% en cualquier producto", "producto gratis", "Ninguno"];

function crearDiv(id) {
    let div = document.createElement('div');
    div.id = id;
    
    return div;
}

function anadirBotonAceptar() {
    let boton = document.createElement('button');
    boton.textContent = 'Aceptar';
    boton.classList.add('btn-juego');
    infoJuego.appendChild(boton);
    boton.addEventListener('click', function() {
        divConcurso.remove();
    });
}

function arrastrandoSobreZona(event) {
    event.preventDefault();
    console.log("Arrastrando sobre la zona");
}

async function generarCodigoDescuento(descuento) {
    const caracteres = 'abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789';
    let fecha = new Date();
    let anyo = fecha.getFullYear().toString();
    let mes = (fecha.getMonth() + 1).toString().padStart(2, '0'); //Con padstart se añade un 0 delante en caso de que el mes sea un solo dígito
    let dia = fecha.getDate().toString().padStart(2, '0');
    let codigo = anyo + mes + dia;
    console.log("Codigo sin randoms: " + codigo);

    for (let i = 0; i < 5; i++) {
        let numeroRandom = Math.random() * caracteres.length; //Numero random entre 0 y la longitud del string
        codigo += caracteres.charAt(Math.floor(numeroRandom)); //Se toma el carácter que está en la posición del número random
    }

    console.log("Codigo final: " + codigo);

    const dataEnvio = {
        "codigo" : codigo,
        "descuento" : descuento
    };

    let data = await enviarDatos('/fetch-guardarCupon', dataEnvio, 'POST', 'Error al guardar el cupón');
    console.log(data);
    return codigo;
}

async function finalizarJuego() {
    infoJuego.innerHTML = '';
    const divJuego = document.getElementById('juego');
    divJuego.remove();
    divConcurso.removeChild(divConcurso.firstElementChild);
    divConcurso.classList.add('justify-center');
    let data = await recibirDatos('/fetch-cambiarJugado', 'POST', 'Error al actualizar el campo jugado del usuario');
    console.log("Campo jugado cambiado: " + data.exitoso);
}

function incrementarFallos() {
    const spanFallos = document.getElementById('fallos');
    if (fallado) {
        fallos++;
        if (fallos != 3) {
            console.log("Has fallado");
        }
        else {
            finalizarJuego();
            infoJuego.innerHTML = '<p>Lo sentimos, has perdido.</p>';
            anadirBotonAceptar();            
        }
        spanFallos.innerHTML = 'Fallos: ' + fallos;
    }
}

function incrementarVelocidad() {
    const dropZona = document.getElementById('dropZona');
    let velocidadAnimacion = dropZona.style.animationDuration;
    console.log("Velocidad actual de animación: " + velocidadAnimacion);

    let nuevaVelocidad = parseFloat(velocidadAnimacion) - 0.25; //Pasamos el valor a decimal para poder restarlo, ya que el valor acaba con un 's'
    dropZona.style.animationDuration = nuevaVelocidad.toString() + "s";
    console.log("Nueva velocidad: " + nuevaVelocidad + "s");
}

async function soltar(event) {
    event.preventDefault();
    const spanNivel = document.getElementById('nivel');
    fallado = false;
    if (nivel < 3) {
        nivel++;
        spanNivel.innerHTML = 'Nivel: ' + nivel;
        incrementarVelocidad();
    }
    else {
        console.log("Has ganado");
        finalizarJuego();
        const indicePremio = Math.floor(Math.random() * premios.length);
        const premio = premios[indicePremio];
        let codigo = '';
        let textoPremio = '<span>¡¡Felicidades!! ¡¡Has ganado!!</span><span>¡Has obtenido un ' + premio + '!</span>';
        switch (indicePremio) {
            case 0:
                codigo = await generarCodigoDescuento(30);
                textoPremio += '<span>Tu código de descuento es: ' + codigo + '</span>';
                break;
            case 1:
                codigo = await generarCodigoDescuento(100);
                textoPremio += '<span>Tu código de descuento es: ' + codigo + '</span>';
                break;
            case 2:
                textoPremio = '<span>Lo sentimos, no has obtenido ningún premio.</span>';
                break;
        }

        infoJuego.innerHTML = textoPremio;
        anadirBotonAceptar();
    }
}

function mostrarJuego() {
    divConcurso.classList.remove('justify-center');
    infoJuego.innerHTML = '<h4>Arrastra el cubo hacia la zona blanca</h4>';

    let divPuntuacion = document.createElement('div');
    divPuntuacion.className = 'flex flex-row justify-between gap-4';
    divPuntuacion.innerHTML = `
        <span class="puntuacion" id="nivel">Nivel: 1</span>
        <span class="puntuacion" id="fallos">Fallos: 0</span>
    `;

    divConcurso.insertBefore(divPuntuacion, infoJuego);

    let divJuego = crearDiv('juego');

    let dropZona = crearDiv('dropZona');
    dropZona.classList.add('bg-white');

    let cubo = crearDiv('cubo');
    cubo.draggable = true;

    divJuego.appendChild(dropZona);
    divJuego.appendChild(cubo);
    divConcurso.appendChild(divJuego);

    dropZona.style.animationDuration = '3s';
    
    dropZona.addEventListener('dragover', arrastrandoSobreZona);
    dropZona.addEventListener('drop', soltar);
    cubo.addEventListener('dragstart', function() {
        fallado = true;
    });
    cubo.addEventListener('dragend', incrementarFallos);
}

if (divConcurso) {
    btnJugar.addEventListener('click', mostrarJuego);
}
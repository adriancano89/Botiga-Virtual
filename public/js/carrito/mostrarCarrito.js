const tablaCarritoLS = document.getElementById('tablaCarritoLS');


function generarTabla() {
    
    for (let i = 0; i < localStorage.length; i++) {
        let key = localStorage.key(i);
        let arraySplit = key.split('-');
        let primeraPosicion = arraySplit[0];

        if (primeraPosicion == 'carrito') { // Comprobar que la clave empieza por 'carrito'
            let cadenaDatos = localStorage.getItem(key);
            console.log(cadenaDatos);
            let datosProducto = JSON.parse(cadenaDatos);
            console.log("Talla: " + datosProducto.talla_id);
            let tr = document.createElement('tr');
            
        }
    }
}



generarTabla();
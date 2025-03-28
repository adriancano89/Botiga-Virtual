let ventasMensuales = document.getElementById("ventasMensuales");
let productos10MasVendidos = document.getElementById("productos10MasVendidos");
let productosStockBajo = document.getElementById("productosStockBajo");

function dibujarCanvasPastel(data, canvas) {
    let grafico = canvas.getContext('2d');

    // Dividimos la data en variables
    const nombresProductos = data.nombresProductos;
    const ventasProductos = data.ventasProductos;
    const coloresProductos = data.coloresProductos;
    const totalVentas = ventasProductos.reduce((acumuladorVentas, i) => acumuladorVentas + Number(i), 0); // El 0 es que acumuladorVentas empieze en 0

    grafico.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas (de posible graficos anteriores)
    grafico.strokeStyle = "black"; // Color dl Borde

    let inicioAngulo = 0; // Ángulo inicial (0 radianes)
    ventasProductos.forEach((venta, i) => { // Recorremos todos los productos vendidos este mes
        let porcentaje = (Number(venta) / totalVentas) * 100; // Calcular el porcentaje respecto a la suma totoal sea 100%
        let finAngulo = inicioAngulo + (porcentaje / 100) * (2 * Math.PI); // Calcular el ángulo final: desde el inicio que que toca hasta el porcentaje que le toque -> (2 * Math.PI) Representa 360º (Todo el pastel)

        // Dibujar el segmento
        grafico.beginPath(); // Inicia un nuevo camino en el canvas
        grafico.moveTo(canvas.width / 3, canvas.height / 2); // Centro del círculo (moueve el lapiz al centro del canvas)
        grafico.arc(canvas.width / 3, canvas.height / 2, 180, inicioAngulo, finAngulo); // Dibujar arco desde el inicio al final (el porcentage del pastel), el numero del medio es el tamaño
        grafico.closePath(); // Cierra el camino actual
        grafico.fillStyle = coloresProductos[i]; // Cada apartado con su #Hexadecimal y tiñe el pastel de su color
        grafico.fill(); // Poner el color
        grafico.stroke(); // Poner el Borde

        inicioAngulo = finAngulo; // Actualizar el ángulo inicial para el siguiente segmento
    });

    // Poner Leyenda
    const margen = 20; // Margen para la leyenda
    const anchoRect = 15; // Ancho de los rectángulos de color
    const altoRect = 15; // Alto de los rectángulos de color

    // Posición inicial de la leyenda
    let posX = canvas.width - 400;
    let posY = margen;

    // Recorre los productos para crear la leyenda
    coloresProductos.forEach((color, i) => {
        // Dibuja el rectángulo de color
        grafico.fillStyle = color;
        grafico.fillRect(posX, posY, anchoRect, altoRect);

        // Dibuja el texto del nombre del producto
        grafico.fillStyle = "black"; // Color del texto
        grafico.fillText(ventasProductos[i] + " " + nombresProductos[i], posX + anchoRect + 5, posY + altoRect - 3); // Ponemos 5 de margen para que no se toque con el cuadrado
        
        posY += altoRect + 3; // Mueve hacia abajo para el siguiente producto
    });
};

function dibujarCanvasBarras(data, canvas) {
    let grafico = canvas.getContext('2d');

    const nombresProductos = data.nombresProductos;
    const stockProductos = data.stockProductos;
    const coloresProductos = data.coloresProductos;

    grafico.clearRect(0, 0, canvas.width, canvas.height); // Limpiar el canvas

    const anchoBarra = 60; // Ancho de cada barra
    const espacioEntreBarras = 30; // Espacio entre barras
    const alturaMaxima = 5; // Altura máxima fija para el stock
    const margen = 100; // Margen para que no este no pegado

    // Dibuja las líneas de referencia
    for (let i = 0; i <= alturaMaxima; i++) {
        const y = (canvas.height / 2) - ((i / alturaMaxima) * ((canvas.height / 2) - 20));
        grafico.beginPath();
        grafico.moveTo(margen - 10, y); // Línea en el margen izquierdo
        grafico.lineTo(canvas.width - margen, y); // Línea en el margen derecho
        grafico.strokeStyle = 'lightgray'; // Color de la línea
        grafico.stroke(); // Dibuja la línea

        // Opcional: dibuja los números al lado de las líneas
        grafico.fillStyle = 'black';
        grafico.fillText(i, margen - 30, y + 5); // Número al lado de la línea
    }

    stockProductos.forEach((stock, i) => {
        let alturaBarra = (stock / alturaMaxima) * ((canvas.height / 2) - 20); // Calcula la altura de la barra
        if (alturaBarra === 0) { // Usa '===' para comparar
            console.log("entro");
            alturaBarra = (0.05 / alturaMaxima) * ((canvas.height / 2) - 20);
        }
        const x = (margen + (i * (anchoBarra + espacioEntreBarras))); // Posición x de la barra

        grafico.fillStyle = coloresProductos[i]; // Color de la barra (que es el del producto)
        grafico.fillRect(x, (canvas.height / 2) - alturaBarra, anchoBarra, alturaBarra); // Dibuja la barra

        // Cambiar color del texto
        if (stock == 0) {
            grafico.fillStyle = 'red'; // Si no hay stock, el color será rojo
        } else {
            grafico.fillStyle = 'black'; // Si hay stock, el color será negro
        }
        grafico.save(); // Guardar el estado del grafico
        grafico.translate((x + anchoBarra / 2) - 100, (canvas.height / 2) + 165); // Poner el texto debajo de la barra
        grafico.rotate(-0.9); // Rotación del texto
        grafico.fillText(nombresProductos[i], 0, 0); // Dibuja el texto en la posición actual
        grafico.restore(); // Restaurar el estado del grafico
    });
};

async function dibujarCanvasVentasMensuales() {
    let data = await recibirDatos('/fetch-graficosVentasMensuales', 'POST', 'Error al recibir datos');

    dibujarCanvasPastel(data, ventasMensuales);
};

async function dibujarCanvas10ProductosMasVendidos() {
    let data = await recibirDatos('/fetch-graficos10ProductosMasVendidos', 'POST', 'Error al recibir datos');

    dibujarCanvasPastel(data, productos10MasVendidos);
};

async function dibujarCanvasProductosStockBajo() {
    let data = await recibirDatos('/fetch-graficosProductosStockBajo', 'POST', 'Error al recibir datos');

    dibujarCanvasBarras(data, productosStockBajo);
};


dibujarCanvasVentasMensuales();
dibujarCanvas10ProductosMasVendidos();
dibujarCanvasProductosStockBajo();
document.addEventListener('DOMContentLoaded', function() {
    const tallaSelect = document.getElementById('talla_id');
    const colorSelect = document.getElementById('color_id');
    const cantidadSelect = document.getElementById('cantidad');

    tallaSelect.addEventListener('change', actualizarCantidad);
    colorSelect.addEventListener('change', actualizarCantidad);

    async function actualizarCantidad() {
        const tallaId = tallaSelect.value;
        const colorId = colorSelect.value;

        if (tallaId && colorId) {
            const dataEnvio = {
                talla_id: tallaId,
                color_id: colorId,
            };

            let data = await enviarDatos('/fetch-ObtenerStock', dataEnvio, 'POST', 'Error al obtener el stock');

            cantidadSelect.innerHTML = ''; // Limpiar opciones anteriores
            if (data.stock > 0) {
                for (let i = 1; i <= data.stock; i++) {
                    const option = document.createElement('option');
                    option.value = i;
                    option.textContent = i;
                    cantidadSelect.appendChild(option);
                }
            } else {
                const option = document.createElement('option');
                option.value = '';
                option.textContent = 'Sin stock';
                option.disabled = true; // Deshabilitar la opción
                option.selected = true;
                cantidadSelect.appendChild(option);
            }
        }
    }
});
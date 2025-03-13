document.addEventListener('DOMContentLoaded', function() {
    const tallaSelect = document.getElementById('talla_id');
    const colorSelect = document.getElementById('color_id');
    const cantidadSelect = document.getElementById('cantidad');

    tallaSelect.addEventListener('change', actualizarCantidad);
    colorSelect.addEventListener('change', actualizarCantidad);

    function actualizarCantidad() {
        const tallaId = tallaSelect.value;
        const colorId = colorSelect.value;

        if (tallaId && colorId) {
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch('/fetch-ObtenerStock', {
                method: 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({
                    talla_id: tallaId,
                    color_id: colorId,
                }),
            })
            .then(response => response.json())
            .then(data => {
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
            })
            .catch(error => console.error('Error:', error));
        }
    }
});
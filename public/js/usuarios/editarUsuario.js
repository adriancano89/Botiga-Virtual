const selects = document.querySelectorAll('.rol');

selects.forEach(select => {
    const rol = select.value;
    select.addEventListener('input', async function() {
        const idUsuario = select.id;
        const nuevoRol = select.value;
        
        const usuario = new Usuario(idUsuario, rol);
        let rolActualizado = await usuario.modificarRol(nuevoRol);
        if (rolActualizado) {
            console.log('Rol modificado con éxito');
        }
    });
});
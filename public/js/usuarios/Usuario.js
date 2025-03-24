class Usuario {
    constructor(id, rol) {
        this.id = id;
        this.rol = rol;
    }

    async modificarRol(nuevoRol) {
        this.rol = nuevoRol;
        console.log("Nuevo rol: " + this.rol);
        const dataEnvio = {
            "rol" : this.rol,
        };
        let data = await enviarDatos('usuarios/' + this.id, dataEnvio, 'PUT', 'Error al cambiar el rol del usuario');
        console.log(data);
        return data.exitoso;
    }
}
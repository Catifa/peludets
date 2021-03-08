loading = false;
llamadaRegisterMascota = {
    userId: 1
};
mascota = {
    userId: 1
};
user = {
    id: 1
};

function registerMascota() {
    this.mascota.userId = this.user.id;

    if ((llamadaRegisterMascota = this.mascota)) {
        ("Registro Completado");
        loading = true;
    } else {
        console.log(error);
        this.loading = false;
    }
}

module.exports = registerMascota;

const { TestScheduler } = require("jest");
const recuperarMascota = require("./metodos/perfilRecuperarMascota");

test("probando utilidad de Perfil recuperar mascota", () => {
    expect(
        recuperarMascota()
    ).toBe();
});
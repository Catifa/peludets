const { TestScheduler } = require("jest");
const registerMascota = require("./metodos/perfilRegisterMascota");

test("probando utilidad de Perfil registrar mascota", () => {
    expect(
        registerMascota()
    ).toBe();
});
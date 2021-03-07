const { TestScheduler } = require("jest");
const deleteMascota = require("./metodos/perfilDeleteMascota");

test("probando utilidad de Perfil delete mascota", () => {
    expect(
        deleteMascota("1")
    ).toBe();
});
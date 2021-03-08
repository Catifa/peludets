const { TestScheduler } = require("jest");
const usuariosFiltrados = require("./metodos/profesionalesUsuariosFiltrados");

test("probando utilidad de Usuarios filtrados", () => {
    expect(
        usuariosFiltrados()
    ).toBe();
});

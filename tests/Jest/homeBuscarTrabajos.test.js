const { TestScheduler } = require("jest");
const buscarTrabajos = require("./metodos/homeBuscarTrabajos");

test("probando utilidad de Buscar Trabajos", () => {
    expect(
        buscarTrabajos()
    ).toBe();
});

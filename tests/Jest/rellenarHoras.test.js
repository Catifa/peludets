const { TestScheduler } = require("jest");
const rellenarHoras = require("./metodos/rellenarHoras");

test("probando utilidad de rellenar horas", () => {
    expect(
        rellenarHoras(5,24)
    ).toBe();
});

const { TestScheduler } = require("jest");
const rellenarHoras = require("./metodos/rellenarHoras");

test("probando utilidad de rellenar horas", () => {
    expect(
        rellenarHoras()
    ).toBe(39);
});

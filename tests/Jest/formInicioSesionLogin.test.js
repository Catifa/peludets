const { TestScheduler } = require("jest");
const login = require("./metodos/formInicioSesionLogin");

test("probando utilidad de Form Inicion Sesion login", () => {
    expect(
        login()
    ).toBe();
});
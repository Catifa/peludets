const { TestScheduler } = require("jest");
const loginTesteo = require("./metodos/formInicioSesionLogin");

jest.mock('axios');

test("probando utilidad de Form Inicion Sesion login", () => {
    expect(
        loginTesteo({email: 'c@c.com', password: '33333'})
    ).toBe(true);
});
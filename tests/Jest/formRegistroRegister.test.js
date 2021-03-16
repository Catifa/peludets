const { TestScheduler } = require("jest");
const register = require("./metodos/formRegistroRegister");

test("probando utilidad de Form Registro registrar ", () => {
    expect(
        register()
    ).toBe();
});
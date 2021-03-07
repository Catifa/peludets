const { TestScheduler } = require("jest");
const calcDistancia = require("./metodos/formulaSitiosInteres");

test("probando utilidad de sitios de interes", () => {
    expect(
        calcDistancia(
            {
                lat: 11,
                lon: 12
            },
            [44, 45]
        )
    ).toBe(4842.736268425906);
});

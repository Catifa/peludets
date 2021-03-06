num1 = 5;
num2 = 24;
horas = [];

function rellenarHoras(num1, num2) {
    for (let i = num1; i < num2; i++) {
        if (i == 24) {
            this.horas.push(i + ":00");
        } else {
            this.horas.push(i + ":00");
            this.horas.push(i + ":30");
        }
    }
}

module.exports = rellenarHoras;

function rellenarHoras() {
    let horas = [];
    for (let i = 5; i <= 24; i++) {
        if (i == 24) {
            horas.push(i + ":00");
        } else {
            horas.push(i + ":00");
            horas.push(i + ":30");
        }
    }
    return horas.length;
}

module.exports = rellenarHoras;

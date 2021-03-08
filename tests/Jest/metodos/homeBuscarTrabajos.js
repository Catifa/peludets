profesiones = [];
profesion = {};
router = [];

function buscarTrabajos() {
    let prof = this.profesion;
    router.push({ name: "profesionales", params: { prof } });
}
module.exports = buscarTrabajos;

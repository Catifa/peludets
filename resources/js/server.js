const app2 = require('./app');

const port = 3000;

app2.listen(port, () => {
    console.log('el servidor esta corriendo por el puerto', port);
});
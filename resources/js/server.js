// Variables del servidor
const axios = require('axios');
//const { response } = require('express');
const fetch = require("node-fetch");
const app = require('express');
const { response } = require('express');
const httpServer = require('http').createServer(app);
const port = process.env.PORT || 1337;
const io = require('socket.io')(httpServer, {
    cors: {
        origin: "*"
    }
});

httpServer.listen(port, () => {
    console.log('Escuchando por el puerto 1337');
});

const users = [];
const rooms = [];

// Chat
io.on('connection', (socket) => {

    // Insertar nombre al usuario
    socket.on('add user', (user) => {
        // Situacion expectacular NO TOCAR, EN SERIO!!!!!!!!!!!!!!!!!!
        users["uwu" + user.id] = socket.id;
    });

    // "Enjaular" a el usuario en una room
    socket.on('room', (room) => {
        let roomName = crearRoomName(room);
        // Ordenar las ID unicamente para insertarlas como indice de array asociativo
        let indexRoom = crearIndexRoom(room);

        // Si la sala no existe se crea y se une el socket a ella
        if (rooms[indexRoom] === undefined) {
            rooms[indexRoom] = roomName;
            io.to(users["uwu" + room.idDestinatario]).emit('invite room', room);
        }

        socket.join(roomName);

        socket.to(rooms[indexRoom]).emit('recuperar chat', recuperarChat(indexRoom));
    });

    // Gestionar las rooms
    socket.on('chat message', (room, msg) => {
        // Socket.room ya no sirve. Hay que mirar la manera de comprobar la sala
        socket.to(room.roomName).emit('chat message', (msg));

        // Metodo para guardar el mensaje en la base de datos
        guardarMensaje({'id': socket.id, 'mensaje': msg})
    });
    
    // Desconexion de la sesion
    socket.on('disconnect', () => {
        users.splice(users.findIndex((i) => {
            return i.id === socket.id;
        }), 1);
    });

});

function crearRoomName(room) {  //Orden de ID's: Mayor > Menor
    if (room.idRemitente > room.idDestinatario)
        return room.idDestinatario + '-' + room.idRemitente + '-' + room.roomName + '-UwU';
    return room.idRemitente + '-' + room.idDestinatario + '-' + room.roomName + '-UwU';
}

function crearIndexRoom(room) {  //Orden de ID's: Mayor > Menor
    if (room.idRemitente > room.idDestinatario)
        return room.idDestinatario + '-' + room.idRemitente;
    return room.idRemitente + '-' + room.idDestinatario;
}

function recuperarChat(room) {
    console.log(room);
    axios.post('http://www.peludets.cat/api/chat/select', {
        idRemitente: room.idRemitente,
        idDestinatario: room.idDestinatario
    }).then((response) => {
        console.log(response.data);
    });
    return null
}

// ADRI, MIRATE ESTO Y AÑADELO AL API SI PUEDES
function guardarMensaje(obj) {
    console.log(obj);
    axios.post('http://www.peludets.cat/api/chat/insert', obj).then(() => {
        console.log('Mensaje guardado');
    }).catch(() => {
        console.log('Error! 💥');
    });
}
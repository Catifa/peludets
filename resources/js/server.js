// Variables del servidor
const axios = require('axios');
const { log } = require('console');
const app = require('express');
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
        // Si la sala no existe se crea y se une el socket a ella
        if (rooms.find(element => element === roomName) === undefined) {
            rooms.push(roomName);

            io.to(users["uwu" + room.idDestinatario]).emit('invite room', room);
        }

        socket.join(roomName);

        socket.room = roomName;
    });

    // Gestionar las rooms
    socket.on('chat message', (msg) => {
        socket.to(socket.room).emit('chat message', (msg));
    });

    // Desconexion de la sesion
    socket.on('disconnect', () => {
        users.splice(users.findIndex((i) => {
            return i.id === socket.id;
        }), 1);
    });

});

function crearRoomName(room) {
    let name;
    if (room.idRemitente > room.idDestinatario) {
        name = room.idDestinatario + '-' + room.idRemitente + '-' + room.roomName + '-UwU';
    } else {
        name = room.idRemitente + '-' + room.idDestinatario + '-' + room.roomName + '-UwU';
    }
    return name;
}
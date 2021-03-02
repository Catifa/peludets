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

let users = [];
let rooms = [];

// Chat
io.on('connection', (socket) => {

    // Insertar nombre al usuario
    socket.on('add user', (user) => {
        // Asignar id al socket para trabajar con el
        socket.id = user.id;
        users.push(socket.id);
    });

    // "Enjaular" a el usuario en una room
    socket.on('room', (room) => {
        let roomName = crearRoomName(room);

        // Si la sala no existe se crea y se une el socket a ella
        if (rooms.find(element => element === roomName) === undefined) {
            rooms.push(roomName);
            console.log(room.idDestinatario);
            // No va y quiero llorar
            io.to(room.idDestinatario).emit('invite room', roomName);
        }

        socket.join(roomName);

        console.log(io.sockets.adapter.rooms);

    });

    // Gestionar las rooms
    socket.on('chat message', (msg) => {

        socket.emit(users);
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
        name = room.idDestinatario + '-' + room.idRemitente + '-' + room.roomName;
    } else {
        name = room.idRemitente + '-' + room.idDestinatario + '-' + room.roomName;
    }
    return name;
}
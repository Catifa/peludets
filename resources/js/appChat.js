/*****************************************************
 *                      Chat                         *
 *****************************************************/

const express = require('express');

const appChat = express();

appChat.use(express.static(__dirname + 'resources/js/components/Profesionales.vue'));

const http = require('http').createServer(appChat);

const socket = require('./socket');
socket(http);

module.exports = appChat;



new Vue({
    el: '#app',
    data: {
      nick: 'Erick'
    }
});
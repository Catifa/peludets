/*****************************************************
 *                      Chat                         *
 *****************************************************/

const express = require('express');

const appChat = express();

appChat.get("/", () => {
  resizeBy.send('Hola');

});

module.exports = appChat;
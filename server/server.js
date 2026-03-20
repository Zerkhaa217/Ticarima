const express = require('express');
const http = require('http').createServer(express());
const io = require('socket.io')(http);
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

let state = {
    companies: [{ id: 1, name: "ZenTech", price: 100 }, { id: 2, name: "MedLife", price: 150 }],
    players: {} 
};

io.on('connection', (socket) => {
    state.players[socket.id] = { name: "Oyuncu " + socket.id.slice(0,4) };
    io.emit('update', state);

    socket.on('chatMessage', (msg) => {
        if (msg.to) {
            // Özel mesaj
            io.to(msg.to).emit('chatMessage', { user: 'Private from ' + msg.from, text: msg.text });
        } else {
            // Genel mesaj
            io.emit('chatMessage', { user: msg.user, text: msg.text });
        }
    });
});

http.listen(3000);

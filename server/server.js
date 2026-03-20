const express = require('express');
const http = require('http').createServer(express());
const io = require('socket.io')(http);
const cors = require('cors');

const app = express();
app.use(cors());
app.use(express.json());

let companies = [
  { id: 1, name: "ZenTech", price: 100, sector: "Tech", history: Array(20).fill(100) },
  { id: 2, name: "MedLife", price: 150, sector: "Health", history: Array(20).fill(150) },
  { id: 3, name: "CryptoCoin", price: 50, sector: "Crypto", history: Array(20).fill(50) }
];

let user = { cash: 5000, portfolio: {}, xp: 0, level: 1 };

io.on('connection', (socket) => {
    socket.on('chatMessage', (msg) => {
        io.emit('chatMessage', { user: msg.user, text: msg.text, time: new Date().toLocaleTimeString() });
    });
    socket.emit('init', { companies, user });
});

setInterval(() => {
    companies = companies.map(c => ({ ...c, price: Math.max(1, c.price + (Math.random()-0.5)*5), history: [...c.history.slice(1), c.price] }));
    io.emit('marketUpdate', { companies, user });
}, 1000);

http.listen(3000, () => console.log('Ticarima Socket Server running...'));

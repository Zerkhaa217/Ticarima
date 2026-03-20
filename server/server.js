const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);

let state = {
    companies: [
        { id: 1, name: "ZenTech", price: 100, sector: "Tech" },
        { id: 2, name: "MedLife", price: 150, sector: "Health" }
    ],
    players: {} // { socketId: { name: "Zen", cash: 5000, portfolio: {} } }
};

io.on('connection', (socket) => {
    state.players[socket.id] = { name: "Oyuncu " + socket.id.slice(0,4), cash: 5000, portfolio: {} };
    
    socket.on('trade', (data) => {
        const { action, companyId } = data;
        let player = state.players[socket.id];
        let company = state.companies.find(c => c.id === companyId);
        
        if (action === 'BUY' && player.cash >= company.price) {
            player.cash -= company.price;
            player.portfolio[companyId] = (player.portfolio[companyId] || 0) + 1;
        }
        io.emit('update', state);
    });
});

setInterval(() => {
    state.companies = state.companies.map(c => ({ ...c, price: Math.max(1, c.price + (Math.random()-0.5)) }));
    io.emit('update', state);
}, 1000);

http.listen(3000);

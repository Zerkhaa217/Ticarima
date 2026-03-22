const express = require('express');
const app = express();
const http = require('http').createServer(app);
const io = require('socket.io')(http);
const cors = require('cors');

app.use(cors());
app.use(express.json());

// Şirket: Hem fabrika hem hisse senedi
let companies = [
  { id: 1, name: "ZenTech", price: 100, stock: 10, productionRate: 1 },
  { id: 2, name: "SolarEnergy", price: 150, stock: 5, productionRate: 2 }
];

io.on('connection', (socket) => {
    socket.on('produce', (id) => {
        let comp = companies.find(c => c.id === id);
        comp.stock += comp.productionRate;
        // Basit arz-talep: Stok arttıkça fiyat düşer
        comp.price = Math.max(1, comp.price * 0.99); 
        io.emit('marketUpdate', companies);
    });
    socket.emit('init', companies);
});

http.listen(3000, () => console.log('Ticarima Hybrid Engine v1 active'));

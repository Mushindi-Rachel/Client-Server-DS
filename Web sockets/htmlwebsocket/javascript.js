const WebSocket = require('ws');
const server = new WebSocket.Server({ port: 3000 });

server.on('connection', (socket) => {
    console.log('Client connected');

    // Listen for messages from the client
    socket.on('message', (message) => {
        console.log(`Received: ${message}`);
        // Echo the message back to the client
        socket.send(`Server received: ${message}`);
    });

    // Connection closed
    socket.on('close', () => {
        console.log('Client disconnected');
    });
});

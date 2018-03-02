var app = require('express')();
var server = require('http').Server(app);
var io = require('socket.io')(server);
var Redis = require('ioredis');
var redis = new Redis();

redis.subscribe('chat');

redis.on('message' , function (channel , message) {

    var data = JSON.parse(message);

    io.emit(channel + ':' + data.event , data.data.message);

    console.log(channel + ':' + data.event);

});

server.listen(3000, function(){
    console.log('Listening on Port 3000');
});
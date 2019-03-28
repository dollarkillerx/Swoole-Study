<?php
// 初始化swoole websocket 对象
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);
// 当建立链接时
$server->on('open','onOpen');

function onOpen($server,$request) {
    print_r($request->fd);
}

// 当客户端发送消息时
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";
    // 发送到客户端 最大2M 
    $server->push($frame->fd, "this is server seccess DollarKiller");
});
// 当客户端结束链接时
$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed\n";
});

$server->start();
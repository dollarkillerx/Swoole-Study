<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 上午10:13
 */
$server = new Swoole\WebSocket\Server("0.0.0.0", 9501);

$server->on('open', 'onOpen');

// 监听webSocket链接打开事件
function onOpen(Swoole\WebSocket\Server $server, $request) {
    print_r($request->fd."\n");
}


// 监听ws消息事件
$server->on('message', function (Swoole\WebSocket\Server $server, $frame) {
    echo "receive from {$frame->fd}:{$frame->data},opcode:{$frame->opcode},fin:{$frame->finish}\n";

    // 向ws链接推送数据
    $server->push($frame->fd, "this is server push success \n");
});


// 关闭ws
$server->on('close', function ($ser, $fd) {
    echo "client {$fd} closed 关闭链接\n";
});


echo 'swoole ws runing 9501';
echo "\n";
// 开启服务
$server->start();
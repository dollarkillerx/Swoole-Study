<?php
$serv = new swoole_server('127.0.0.1',9506);
$serv->set([
    'worker_num' => 6,
    'max_request' => 10000
]);

$serv->on('connect',function($serv,$fd,$from_id){
    echo "{$fd} 你以建立与本服务器的链接 线程为{$from_id}\n";
});

$serv->on('receive',function($serv,$fd,$from_id,$data){
    $serv->send($fd,"{$fd}你的线程为{$from_id} 你的请求数据为{$data}\n");
});

$serv->on('close',function($serv,$fd){
    echo "{$fd}用户退出\n";
});

$serv->start();
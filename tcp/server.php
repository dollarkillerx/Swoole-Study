<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-2-19
 * Time: 下午5:42
 */
//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("127.0.0.1", 9501);

$serv->set([
    'worker_num' => 8,//worker进程数 标准cpu核数的1-4被
    'max_request' => 10000,//处理最大用户数

]);

//监听连接进入事件
/**
 * $fd客户端链接唯一表示
 * $reactor_id 线程id
 */
$serv->on('connect', function ($serv, $fd) {
    echo "Client: Connect.\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, "Server: {$from_id}".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.\n";
});

//启动服务器
$serv->start();
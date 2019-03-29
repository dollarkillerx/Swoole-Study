<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-28
 * Time: 下午8:36
 */

//创建Server对象，监听 127.0.0.1:9501端口
$serv = new swoole_server("0.0.0.0", 5050);

$serv->set([
    'worker_num' => 8,// 启动8个worker
    'max_request' => 10000,// 每个worker最大链接数
]);

//监听连接进入事件 $fd 客户端链接唯一表示 $from_id 线程id
$serv->on('connect', function ($serv, $fd,$from_id) {
    echo "Client: Connect.{$fd}  :   {$from_id}\n";
});

//监听数据接收事件
$serv->on('receive', function ($serv, $fd, $from_id, $data) {
    $serv->send($fd, $from_id." : Server: ".$data);
});

//监听连接关闭事件
$serv->on('close', function ($serv, $fd) {
    echo "Client: Close.  {$fd} \n";
});
echo "server is runing \n";
//启动服务器
$serv->start();

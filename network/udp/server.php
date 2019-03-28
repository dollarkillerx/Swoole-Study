<?php
 // 初始化server
 $server = new swoole_server('127.0.0.1',9506,SWOOLE_PROCESS,SWOOLE_SOCK_UDP);

 $server->set([
     'worker_num' => 6,
     'max_request' =>10000,
 ]);

 // 监听数据接受事件
 $server->on('Packet',function($server,$data,$clientInfo){
    $server->sendto($clientInfo['address'],$clientInfo['port'],"这是你请求的数据{$data}");
 });

 // 启动服务器
 $server->start();
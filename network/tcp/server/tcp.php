<?php 
// 创建server对象
$serv = new swoole_server("127.0.0.1",9501);

// 设置运行时参数
$serv->set([
    'worker_num' => 8 ,// 开启worker进程数 标准数量为cpu核数1-4倍
    'max_request' => 10000, // 最大用户数  更具内存选择
]);

/**
 * 监听链接进入事件
 * $serv server对象
 * $fd 客户端链接唯一标示
 * $reactor_id 线程id
 */
$serv->on('connect',function($serv,$fd,$reactor_id){
    echo "Client: {$reactor_id} - {$fd} Connect\n";
});

/**
 * 监听数据接收事件
 * $fd 服务器唯一标示
 * $from_id 线程id
 * $data 客户端发送数据
 * $serv->send($fd必填,$data)
 */
$serv->on('receive',function($serv,$fd,$from_id,$data){
    $serv->send($fd,"Server: {$from_id} - {$fd}".$data);
});

// 监听链接关闭事件
$serv->on('close',function($serv,$fd){
    echo "{$fd} Client: Close .\n";
});

// 启动服务器
$serv->start();
echo "访问以启动";
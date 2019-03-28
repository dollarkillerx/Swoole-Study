<?php
//  创建swoole client 对象
$client = new swoole_client(SWOOLE_SOCK_TCP);
// 链接swoole tcp
if(!$client->connect('127.0.0.1',9501)) {
    echo '链接失败';
    exit();
}
// php 内置cli常量
fwrite(STDOUT,'请输出消息:');
$msg = trim(fgets(STDIN));

// 发送消息给tcp server
$res = $client->send($msg);
if(!$res) {
    echo '发送失败';
}

// 接受来自server 的数据
$result = $client->recv();
echo $result;

<?php
$client = new swoole_client(SWOOLE_SOCK_UDP);

$client->connect('127.0.0.1',9506);

$client->send('向UDP端口发送数据');

$result = $client->recv();
echo $result;

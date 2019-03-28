<?php
$client = new swoole_client(SWOOLE_SOCK_TCP);

$client->connect('127.0.0.1',9506);

$client->send('hello');

$result = $client->recv();

echo $result;
<?php
// 创建swoole server对象 0.0.0.0 监听所有ip
$http = new swoole_http_server("0.0.0.0",8811);

// 配置
$http->set([
    'enable_static_handler' => true, // 解析静态资源
    'document_root' => '/home/wangye/github/Swoole-Study/network/data', // 静态资源目录
]);

// 绑定请求
$http->on('request',function($request,$response){
    print_r($request->header);
    $response->end('<h1>HttpServer</h1>');
});

$http->start();
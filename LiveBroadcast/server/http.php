<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午8:04
 */

$server = new Swoole\Http\Server("0.0.0.0", 80);

$server->set([
    'document_root' => '/data/public/static',
    'enable_static_handler' => true,
    'worker_num' => 4,
]);

$server->on('WorkerStart',function ($serv, $worker_id) {
    // 加载基础文件
        require __DIR__ . '/../thinkphp/base.php';
});

$server->on('request', function ($request, $response) use($server) {
    if(isset($request->server)) {
        foreach ($request->server as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    if(isset($request->header)) {
        foreach ($request->header as $k => $v) {
            $_SERVER[strtoupper($k)] = $v;
        }
    }

    if(!empty($_GET)) {
        unset($_GET);
    }

    if(isset($request->get)) {
        foreach ($request->get as $k => $v) {
            $_GET[$k] = $v;
        }
    }

    if(isset($request->post)) {
        foreach ($request->post as $k => $v) {
            $_POST[$k] = $v;
        }
    }

    ob_start();
    // 执行应用并响应
    try{
        think\Container::get('app')->run()->send();
    }catch (\Exception $e){
        // todo
    }
    $res = ob_get_contents();
    ob_end_clean();

    $response->end($res);
    $server->close($server->worker_id);
});



$server->start();
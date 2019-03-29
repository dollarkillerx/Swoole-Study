<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-28
 * Time: 下午9:30
 */

$http = new swoole_http_server('0.0.0.0',8811);

$http->on('request',function ($req,$res){
//    $res->end("<h1>HTTPserver</h1>");
//    print_r($req->get);
//    $res->end("<h1>".json_encode($req->get)."</h1>");
    $res->cookie('dollarkiller','xsssssss',time() + 1800);
    $res->end('sss'.json_encode($req->get));
});

$http->start();


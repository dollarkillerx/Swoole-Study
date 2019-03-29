<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午5:07
 */
go(function (){
    $redis = new Swoole\Coroutine\Redis();
    $redis->connect('172.17.0.4', 6379);
    $val = $redis->get('key');
    print_r($val);
});
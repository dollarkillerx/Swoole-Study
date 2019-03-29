<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午6:25
 */

$process = new \Swoole\Process(function (swoole_process $process) {
    $process->exec("/www/server/php7/bin/php",[__DIR__.'/echo.php']);
},true);

$pid = $process->start();

echo $pid . PHP_EOL;

swoole_process::wait(); //当结束时候回收子进程
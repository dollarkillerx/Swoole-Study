<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午3:23
 */

$file_handle = fopen('./test.txt','r');

co::create(function () use ($file_handle) {
    fseek($file_handle, 30);
    $r = co::fread($file_handle);
    var_dump($r);
});
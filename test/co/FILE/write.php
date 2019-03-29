<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午3:32
 */

$fh = fopen('./test.txt','r');
$fp = fopen('./me.txt','a+');

co::create(function () use ($fh,$fp) {
    fseek($fh,50);
    $r = co::fread($fh);
    $p = co::fwrite($fp,$r);
});
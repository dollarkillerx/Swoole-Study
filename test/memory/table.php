<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午7:07
 */

// 创建内存表
$table = new Swoole\Table(1024);

// 内存表增加一列
$table->column('id',$table::TYPE_INT,4);
$table->column('name',$table::TYPE_STRING,64);
$table->column('age',$table::TYPE_INT,4);
$table->create(); # 创建

// 插入
$table->set('dol_kil',['id' => 1,'name' => 'dollarkiller','age' => 30]);

// 方案 二
$table['dol_kil1'] = [
    'id' => 2,
    'name' => 'doPsFor',
    'age' => 33
];

print_r($table->get('dol_kil'));

print_r($table->get('dol_kil1'));

print_r($table['dol_kil1']);

$table->incr('dol_kil1','age',2);
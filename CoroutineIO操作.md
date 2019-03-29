# Coroutine IO操作等:

异步操作已过时!!! 推荐Coroutine携程的方式

### 毫秒级定时器:
- `swoole_timer_tick` 每隔多少毫秒执行异常
- `swoole_timer_after` 只执行一次
```
# 每2s执行 $timer_id 为定时器id
swoole_timer_tick(2000,function($timer_id){
    echo "{$timer_id} ";
})
```

### 协程文件读写

#### 读
```
$file_handle = fopen('./test.txt','r');

co::create(function () use ($file_handle) {
    fseek($file_handle, 30);
    $r = co::fread($file_handle);
    var_dump($r);
});
```
#### 写
```
$fh = fopen('./test.txt','r');
$fp = fopen('./me.txt','a+');

co::create(function () use ($fh,$fp) {
    fseek($fh,50);
    $r = co::fread($fh);
    $p = co::fwrite($fp,$r);
});
```

### 协程 Mysql
演示代码:test>cp>mysql

### 异步Redis
- 需要安装一个第三方的异步Redis库hiredis
    ``` 
    apk add build-base
    wget ...
    unzip ...
    make -j
    make install
    ldconfig
    ```
- 需要在编译时增加--enable-async-redis来开启此功能  4.0可以不用
- 请勿同时使用异步回调和协程Redis
# Swoole-Study
Swoole-Study

### TCP服务器
```
$host = '0.0.0.0';//监听所有IP string
$port = 1086;//int
$server = new swoole_server($host,$port,$mode,$sock_type);``
/**
$host ipv4 ipv6
$port 端口  选择1024一下的端口需要root权限
$mode 模式 默认：SWOOLE_process多进程
$sock_type 默认swoole_sock_tcp

//使用
bool $swoole_server->on(string $event,mixed $callback);//$event,回调函数
$event:
connect:当建立链接的时候  默认参数 $server当前创建server的句柄($server:服务器信息，$fd客户端id)
receive:当接收到数据     默认参数 $server服务器信息，$fd客户端id，$from_id线程id，$data传递的数据
close:关闭链接

**/

//发起链接
$server->on('connect',function($server,$fd){
    var_dump($server);
    var_dump($fd);
    echo '建立链接\n';
});

//接收
$server->on('receive',function($server,$fd,$from_id,$data){
    echo '接收到数据\n';
    var_dump($data);
});

//关闭链接
$server->on('close',function($server,$fd){
    echo('链接关闭\n');
}); 

//启动服务器
$server->start();
```



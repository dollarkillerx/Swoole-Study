<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 上午10:49
 */

/**
 * Swoole WebSocket 优化基础类库
 * Class Ws
 */
class Ws
{
    CONST HOST = '0.0.0.0';
    CONST PORT = 9501;

    public $ws = null;

    public function __construct() {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);

        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);
        $this->ws->on('close',[$this,'onClose']);

        echo "Swoole WebSocket Server runing...";
        $this->ws->start();
    }

    /**
     * 监听WS链接事件
     * @param \Swoole\WebSocket\Server $server
     * @param $request
     */
    public function onOpen(Swoole\WebSocket\Server $server, $request) {
        var_dump($request->fd);
    }

    /**
     * 监听ws消息事件
     * @param \Swoole\WebSocket\Server $server
     * @param $frame
     */
    public function onMessage(Swoole\WebSocket\Server $server, $frame) {
        echo "ser-push-message:{$frame->data}\n";

        $server->push($frame->fd,"server-push".date("Y-m-d H:i:s"));
    }

    /**
     * 监听客户端关闭链接
     * @param $ser
     * @param $fd
     */
    public function onClose($ser, $fd) {
        echo "client {$fd} closed \n";
    }

}

$ws = new Ws();

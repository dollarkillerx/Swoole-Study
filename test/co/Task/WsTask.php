<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午1:56
 */

class WsTask
{
    CONST HOST = '0.0.0.0';
    CONST PORT = 9501;

    public $ws = null;

    public function __construct() {
        $this->ws = new Swoole\WebSocket\Server(self::HOST, self::PORT);

        $this->ws->set(array(
            'worker_num' => 4,    //worker process num
            'backlog' => 128,   //listen backlog
            'max_request' => 50,
            'dispatch_mode'=>1,
            'task_worker_num'=>5
        ));

        $this->ws->on('open',[$this,'onOpen']);
        $this->ws->on('message',[$this,'onMessage']);

        $this->ws->on('task',[$this,'onTask']);
        $this->ws->on('finish',[$this,'onFinish']);

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
        // todo 10s
        $data = [
            'task' => 1,
            'fd' => $frame->fd
        ];
        // 投放异步任务
//        $server->task($data);

        swoole_timer_tick(1000,function () use ($server,$frame){
            echo '5s-after\n';
            $server->push($frame->fd,"server-time-after: \n");
        });

        $server->push($frame->fd,"server-push".date("Y-m-d H:i:s"));
    }

    /**
     * @param swoole_server $serv
     * @param int $task_id
     * @param string $data
     */
    public function onFinish(swoole_server $serv, int $task_id, string $data) {
        echo "taskId: {$task_id} \n";
        echo "finish-data-sucess:{$data}\n";
    }

    /**
     * @param swoole_server $serv
     * @param int $task_id
     * @param int $src_worker_id
     * @param $data
     */
    public function onTask(swoole_server $serv, int $task_id, int $src_worker_id, $data) {
        print_r($data);
        // 耗时场景 10s
        sleep(10);
        return 'on task finish'; //告诉worker
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

$ws = new WsTask();

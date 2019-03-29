<?php
/**
 * Created by PhpStorm.
 * User: wangye
 * Date: 19-3-29
 * Time: 下午3:43
 */

class CoMysql
{
    public $db = null;
    public $dbCnf = null;

    public function __construct() {
        $this->db = new Swoole\Coroutine\MySQL();

        $this->dbCnf = [
            'host' => '172.17.0.3',
            'port' => 3306,
            'user' => 'test',
            'password' => 'test',
            'database' => 'test',
            'charset' => 'utf8'
        ];
    }

    public function update() {

    }

    public function add() {

    }

    /**
     * mysql 执行逻辑
     * @param $id
     * @param $username
     * @return bool
     */
    public function execute($id,$username) {
        // content
        $this->db->connect($this->dbCnf);
//        return $this->db->query("select * from test where id = {$id} and username = {$username}");
//        return true;
        return  $this->db->query('update test set username = "'.$username.'" where id = '.$id);
//        return 'update test set username = "'.$username.'" where id = '.$id;
    }

}

co::create(function (){
    $obj = new CoMysql();
    $res = $obj->execute(1,'dollasdasdasd');
    print_r($res);
});

//co::create(function (){
//    $swoole_mysql = new Swoole\Coroutine\MySQL();
//    $swoole_mysql->connect([
//        'host' => '172.17.0.3',
//        'port' => 3306,
//        'user' => 'test',
//        'password' => 'test',
//        'database' => 'test',
//        'charset' => 'utf8'
//    ]);
//    $res = $swoole_mysql->query('select * from test');
//    print_r($res);
//});
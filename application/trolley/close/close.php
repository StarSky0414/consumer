<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-16
 * Time: 上午9:06
 */

class close
{

    private $trolley_sql;

    private $my_redis;

    public function __construct()
    {
        $this->trolley_sql = new trolley_sql();
        $this->my_redis = new my_redis();
    }

    private function get_room_id($user_id){
        $room_id = $this->my_redis->get_room_id($user_id);
        $this->my_redis->get_room_user($room_id);
    }

    public function get_user_list($user_id){
        $room_id = $this->my_redis->get_room_id($user_id);
        $this->my_redis->get_room_user($room_id);
    }
}
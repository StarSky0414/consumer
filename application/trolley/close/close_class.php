<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-16
 * Time: 上午9:06
 */

class close_class
{

    private $trolley_sql;
    private $my_redis;

    public function __construct()
    {
        $this->trolley_sql = new trolley_sql();
        $this->my_redis = new my_redis();
    }

    public function close_user($userId,$close_id_array)
    {
        $house_owner_id = $this->my_redis->get_house_owner_id($userId);
        $close_user=false;
        if ($house_owner_id==$userId){
            $close_user = $this->my_redis->close_user($userId,$close_id_array);
        }
        return $close_user;
    }
}
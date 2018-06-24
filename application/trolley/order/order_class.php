<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-15
 * Time: 下午4:29
 */

class order_class
{

    private $trolley_sql;

    public function __construct()
    {
        $this->trolley_sql =new trolley_sql();
    }

    public function get_user_nickname($userId)
    {
        $user_nickname_sql = $this->trolley_sql->get_user_nickname_sql($userId);
        return $user_nickname_sql;
    }

    public function item_change($userId,$item_id,$operate)
    {
        $my_redis = new my_redis();
        $user_nickname = $this->get_user_nickname($userId);
        $item_change = $my_redis->item_change($userId, $user_nickname, $item_id, $operate);
//        var_dump($item_change);
        return $item_change;

    }

    public function synchronization($user_id,$user_version)
    {
        $my_redis = new my_redis();
        $room_id = $my_redis->get_room_id($user_id);
        $version_num = $my_redis->get_version_num($room_id);
        $synchronization = $my_redis->synchronization($room_id, $user_version*3-2, $version_num*3);
        $synchronization_list=[];
        $p=0;
        for ($i=0;$i<($version_num-$user_version);$i++){
            $synchronization_list[$i]['item']=$synchronization[$p++];
            $synchronization_list[$i]['op']=$synchronization[$p++];
            $synchronization_list[$i]['nickname']=$synchronization[$p++];
        }
//        print_r($synchronization_list);
        return $synchronization_list;
    }


}
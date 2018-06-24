<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-15
 * Time: 下午4:32
 */

$join_class = new join_class();
$my_redis = new my_redis();

$userId = UserInfo::getUserId();
$user_version_number = $_POST['user_version_number'];
$order_class = new order_class();
$synchronization = $order_class->synchronization($userId, $user_version_number);

$member_list = $my_redis->member_list($userId);


$result['room_state']=true;
$room_id = $my_redis->get_room_id($userId);
$version=$my_redis->get_version_num($room_id);
$result['version_num']=$version;
foreach ($member_list as $value){
    $result['member_list'][]=$order_class->get_user_nickname($value);
}
$result['item_info']=$synchronization?$synchronization:[];
$json_encode = json_encode($result, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $json_encode);
print_r($str_replace);
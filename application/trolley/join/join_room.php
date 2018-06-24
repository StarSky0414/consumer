<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-15
 * Time: 上午3:14
 */

//$join_class = new join_class();
//$join_class->

$userId = UserInfo::getUserId();
$my_redis = new my_redis();
$join_class = new join_class();
$join_get_map = $my_redis->join_room($userId);
//var_dump($join_get_map);
if (empty($join_get_map)){
    echo '{"order_status":false,"mer_item":[],"discount":"","VIP_name":"","create_time":"","this_version_number":""}';
    return ;
}
//print_r($join_get_map);
$json_array_list = $join_class->json_array_list($userId);
$json_encode = json_encode($json_array_list, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $json_encode);
print_r($str_replace);



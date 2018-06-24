<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-22
 * Time: 下午5:56
 */

$userId = UserInfo::getUserId();
$my_redis = new my_redis();
$close_class = new close_class();
$member_list = $my_redis->member_list($userId);
$member_list[]=$userId;
print_r($member_list);
$close_user = $close_class->close_user($userId,$member_list);
echo $close_class?1:0;

<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-14
 * Time: 上午9:10
 */
require_once dirname(__FILE__).'/../../../Tool/MailReg.php';

$mer_id = $_POST['mer_id'];
$userId = UserInfo::getUserId();

$create_class = new create_class();
$make_room_id = $create_class->make_room_id();
$mer_item = $create_class->create_room($mer_id, $userId);
//print_r($make_room_id);
$my_redis = new my_redis();
//$room_id,$house_owner,$mer_id,$timestamp
$my_redis->create_room($make_room_id,$userId,$mer_id,time());
$json_encode = json_encode($mer_item, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $json_encode);
print_r($str_replace);
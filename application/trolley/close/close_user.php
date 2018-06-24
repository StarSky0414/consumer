<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-16
 * Time: 上午8:51
 */

$userId = UserInfo::getUserId();
$close_user_id[] = $_POST['close_user_id'];
if ($userId==$close_user_id[0]){
    echo 0;
    return;
}
$my_redis = new my_redis();
$close_class = new close_class();
$close_user = $close_class->close_user($userId,$close_user_id);
echo $close_class?1:0;

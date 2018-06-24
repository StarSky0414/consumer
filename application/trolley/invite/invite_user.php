<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午10:50
 */

require_once dirname(__FILE__).'/../../../Tool/Push.php';

$my_redis = new my_redis();
$invite_user = $_POST['invite_user'];
$active="";
$invite_class = new invite_class();
$invite_user_name = $invite_class->user_name($invite_user);
$userId = UserInfo::getUserId();
if ($my_redis->invite_list_hashmap($userId,$invite_user)) {
    Push::push_notice("ACCOUNT",$invite_user_name,$active,"{}","有人邀请您点餐","您有一条消息");
}
//echo "Push ok";
echo 1;
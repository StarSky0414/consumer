<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午2:22
 */

$userId = UserInfo::getUserId();
$invite_class = new invite_class();
$user_concern = $invite_class->user_concern($userId);
$result = json_encode($user_concern, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $result);
print_r($str_replace);
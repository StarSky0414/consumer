<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午10:26
 */

$user_name_path = $_POST['user_name_path'];
$list_id = $_POST['list_id'];
$invite_class = new invite_class();
$user_info['user_list'] = $invite_class->find_user_name($user_name_path,$list_id);
//if (empty($user_info)){
//    echo '{"id":"","photo":"","nickname":""}';
//    return;
//}
$user_info_json = json_encode($user_info, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $user_info_json);
print_r($str_replace);
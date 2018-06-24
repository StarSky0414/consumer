<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/31
 * Time: 9:37
 */
require_once  dirname(__FILE__).'/../indent/indent_class.php';
require_once dirname(__FILE__).'/../../sql/indent_sql.php';

if (!isset($_POST['key_value']) || !isset($_POST['room_id'])) {
    echo 1;
    return;
}

$indent_class = new indent_class();
$room_id = $_POST['room_id'];
$room_user_list = $indent_class->find_room_user_list($room_id);
$implode = implode(',', $room_user_list);
$push_info = Push::push_message('ACCOUNT', $implode, "{\"k1\":\"ios\",\"k2\":\"v2\"}", 'delete_room', $_POST['key_value']);
$redis = new Redis();
$redis->connect('127.0.0.1', '6379');
$key = "sweet:trolley:menue:$room_id:map";
$redis->delete($key);
//print_r($push_info);
//
//if ($push_info){
//    echo 1;
//    return ;
//}
ob_end_clean();
//echo 0;
//echo $upload_indent;
echo 1;
return;
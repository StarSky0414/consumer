<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/11
 * Time: 15:16
 */
require_once dirname(__FILE__) . '/../../Tool/Push.php';

$mer_id = $_POST['mer_id'];
$money = $_POST['money'];
$trolley_list = $_POST['trolley_list'];
$indent_info = $_POST['indent_info'];
ob_start();
$user_id = UserInfo::getUserId();
$indent_class = new indent_class();
$upload_indent = $indent_class->upload_indent($user_id, $mer_id, $trolley_list, $indent_info, $money);
if ($upload_indent) {
    $mer_name = $indent_class->find_mer_name_list($mer_id);
    print_r($mer_name);
    Push::push_notice('ACCOUNT', $mer_name, '', $indent_info, '预定消息', '您有一个新的预定消息，请及时处理！');
    echo $upload_indent;
    //push跳转未设定
    /*if (!isset($_POST['key_value']) || !isset($_POST['room_id'])) {
        ob_end_clean();
        echo 1;
        return;
    }
    $room_id = $_POST['room_id'];
    $room_user_list = $indent_class->find_room_user_list($room_id);
    $implode = implode(',', $room_user_list);
    Push::push_message('ACCOUNT', $implode, "{\"k1\":\"ios\",\"k2\":\"v2\"}", 'delete_room', $_POST['key_value']);
    $redis = new Redis();
    $redis->connect('127.0.0.1', '6379');
    $key = "sweet:trolley:menue:$room_id:map";
    $redis->delete($key);
    ob_end_clean();
    echo $upload_indent;
    return;*/
} else {
    echo 0;
    return;
}
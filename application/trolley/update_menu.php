<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/8
 * Time: 0:20
 */

ob_start();
$trolley_class = new trolley_class();
$room_id = $_POST['room_id'];
$item = $_POST['item'];
$incr_decr = $_POST['incr_decr'];
$body = $_POST['key_value'];
$room_user_list = $trolley_class->find_room_user_list($room_id);
print_r($room_user_list);
$implode = implode(',', $room_user_list);
print_r($implode);
if ($trolley_class->update_menu($room_id,$item,$incr_decr)) {
    $trolley_class->push($implode,'update_menu',$body);
    ob_end_clean();
    echo 1;
    return;
}
ob_end_clean();
echo 0;
return;
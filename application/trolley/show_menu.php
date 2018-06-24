<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/8
 * Time: 11:36
 */

require_once dirname(__FILE__) . '/../../sql/vip_sql.php';
require_once dirname(__FILE__) . '/../vip/vip_class.php';

ob_start();

$trolley_class = new trolley_class();/*
$password = $_POST['password']=200;
$room_id = $_POST['room_id']=200;
$key_value = $_POST['key_value']='{}';*/

if (isset($_POST['room_id'])) {
    $room_id =$_POST['room_id'];
    $key_value = $_POST['key_value'];
    $mer_id = $trolley_class->get_mer_id($room_id);
    $show_menu = $trolley_class->show_menu($room_id);
//    print_r($show_menu);
    $userId = UserInfo::getUserId();
    $room_user_list = $trolley_class->find_room_user_list($room_id);
    $implode = implode(',', $room_user_list);
    print_r($implode);
    $trolley_class->member_join($userId, $room_id);
    if (!empty($implode)){
        $trolley_class->push($implode, 'join_room', $key_value);
    }
} elseif ($_POST['mer_id']) {
    $mer_id = $_POST['mer_id'];
}else{
    ob_end_clean();
    echo 0;
    return;
}
/*
if ($show_menu = $trolley_class->show_menu($room_id)) {
    $trolley_class->push($room_id, 'join_room', $key_value);*/

$classify_select = $trolley_class->classify_select($mer_id);
$vip_class = new vip_class();  //创建vip class
$vip_discount = $vip_class->vip_discount(UserInfo::getUserId(), $mer_id);
$VIP_name = $vip_discount['VIP_name'];
$item_list = '';
if (isset($VIP_name)) {
    $discount = $vip_discount['discount'];
//            $item_list = $vip_discount['item_list'];
} else {
    $VIP_name = '';
    $discount = '1';
//            $item_list='{"item":[]}';
}
foreach ($classify_select as $key => $value) {
    $show_item = $trolley_class->show_item($value['class_id']);
    foreach ($show_item as $key1 => $value1) {
        if ($value1['discount_singe']) {
            if ($value1['discount'] == '-1') {
                $show_item[$key1]['discount']=$discount;
                $show_item[$key1]['discount_result'] = (string)($value1['univalence'] * (double)$discount);
            } else {
                $show_item[$key1]['discount_result'] = (string)($value1['univalence'] * (double)$value1['discount']);
            }
        }else{
            $show_item[$key1]['discount']='1';
            $show_item[$key1]['discount_result'] =$value1['univalence'];
        }
    }
    $classify_select[$key] ['item'] = $show_item;
}
$item_list_o['item_list'] = $classify_select;
$item_list_o['VIP_name'] = $VIP_name;
$item_list_o['vip_discount'] = empty($VIP_name)?'':$discount;
ob_end_clean();
echo json_encode($item_list_o, JSON_UNESCAPED_UNICODE);

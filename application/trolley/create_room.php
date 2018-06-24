<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/7
 * Time: 19:36
 */

$mer_id = $_POST['mer_id'];
$trolley_class = new trolley_class();
//$room_id=$trolley_class->spop_pool();
$mySession = new MySession;
$room_id=md5(uniqid(md5(microtime(true)),true));

if ($trolley_class->create_room($mer_id,$room_id)) {
    echo  $room_id;
    return;
}
echo 0;
return;
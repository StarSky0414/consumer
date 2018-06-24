<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/7
 * Time: 23:34
 */


$mer_id = $_POST['mer_id'];
$trolley_class = new trolley_class();
//$room_id=$trolley_class->spop_pool();
$mySession = new MySession;
$room_id=md5(uniqid(md5(microtime(true)),true));

if ($trolley_class->update_password($mer_id,$room_id,$password,$old_password)) {
    if($old_password==null){
        echo  $room_id;
        return;
    }
    echo 1;
    return;
}
echo 0;
return;
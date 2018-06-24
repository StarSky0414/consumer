<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/7
 * Time: 18:30
 */

$room_id = $_POST['room_id'];
$trolley_class = new trolley_class();
$pw_ver = $trolley_class->pw_ver($room_id);
if ($pw_ver){
    echo 1;
    return ;
}
echo 0;
return;
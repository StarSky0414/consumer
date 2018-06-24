<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/6
 * Time: 21:11
 */

$room_id = $_POST['room_id'];
$trolley_class = new trolley_class();
$confirm = $trolley_class->confirm($room_id);
echo json_encode($confirm,JSON_UNESCAPED_UNICODE);
//print_r($confirm);
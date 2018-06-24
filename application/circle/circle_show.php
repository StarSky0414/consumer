<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 14:27
 */


$type = $_POST['type'];  // 朋友
$start = $_POST['start'];
ob_start();
$user_id=UserInfo::getUserId();
$circle_class = new circle_class();
$circle_show = $circle_class->circle_show($type,$start,$user_id);
$json_encode = json_encode($circle_show, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('null', '""', $json_encode);
ob_end_clean();
echo ($json_encode);
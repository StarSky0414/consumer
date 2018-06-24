<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/16
 * Time: 15:35
 */


$userId = UserInfo::getUserId();
$myself_class = new myself_class();
$myself_info = $myself_class->myself_info($userId);
//print_r($myself_info);
$myself_info=str_replace('null',"\"\"",$myself_info);
echo json_encode($myself_info,JSON_UNESCAPED_UNICODE);
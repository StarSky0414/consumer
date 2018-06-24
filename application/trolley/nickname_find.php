<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/25
 * Time: 13:16
 */

$name_part = $_POST['name_part'];
$start = $_POST['start'];
$trolley_class = new trolley_class();
$nickname_find['nickname_list'] = $trolley_class->nickname_find($name_part,$start);
//print_r($nickname_find);
//$nickname_list = json_encode($nickname_find, JSON_UNESCAPED_UNICODE);
//echo $json_encode;
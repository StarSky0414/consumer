<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/27
 * Time: 13:28
 */

$name_part = $_POST['name_part'];
$start = $_POST['start'];

$trolley_class = new trolley_class();
$nickname_find['user_list'] = $trolley_class->nickname_find($name_part, $start);
//print_r($nickname_find);
echo json_encode($nickname_find,JSON_UNESCAPED_UNICODE);
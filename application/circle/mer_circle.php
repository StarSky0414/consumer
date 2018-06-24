<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/17
 * Time: 9:27
 */

$mer_id = $_POST['mer_id'];  // 朋友
$start = $_POST['start'];
$circle_class = new circle_class();
$circle_show = $circle_class->circle_show('mer_circle',$start,$mer_id);
$json_encode = json_encode($circle_show, JSON_UNESCAPED_UNICODE);
$str_replace = str_replace('""', 'null', $json_encode);
print_r($str_replace);
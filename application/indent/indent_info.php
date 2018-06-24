<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/16
 * Time: 10:58
 */


$indent_id = $_POST['indent_id'];
$indent_class = new indent_class();
$indent_info = $indent_class->indent_info($indent_id);
if (empty($indent_info)){
    echo '0';
    return;
}
$json_encode = json_encode($indent_info, JSON_UNESCAPED_UNICODE);
$json_encode=str_replace('null',"\"\"",$json_encode);
echo $json_encode;
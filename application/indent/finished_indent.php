<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/16
 * Time: 10:14
 */

$userId = UserInfo::getUserId();
$indent_class = new indent_class();
$str['unfinish_indent_list'] = $indent_class->finish_indent($userId);
if (!empty($str['unfinish_indent_list'])) {
    $json_encode = json_encode($str, JSON_UNESCAPED_UNICODE);
    $json_encode=str_replace('null',"\"\"",$json_encode);
    echo $json_encode;
    return;
}else{
    echo "{unfinish_indent_list:[]}";
    return;
}
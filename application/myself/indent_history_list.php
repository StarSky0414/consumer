<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 18:40
 */


$start = $_POST['start'];
$userId = UserInfo::getUserId();
$myself_class = new myself_class();
$indent_history_lsit['indent_history_lsit'] = $myself_class->indent_history_lsit($userId,$start);
if (!empty($indent_history_lsit['indent_history_lsit'])) {
    $json_encode = json_encode($indent_history_lsit, JSON_UNESCAPED_UNICODE);
    $explode = str_replace("null", '""', $json_encode);
    echo $explode;
} else {
    echo '{"indent_history_lsit":[]}';
}
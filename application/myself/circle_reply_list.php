<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 19:15
 */

$start = $_POST['start'];
$userId = UserInfo::getUserId();
$myself_class = new myself_class();
$circle_reply_lsit['circle_reply_lsit'] = $myself_class->circle_reply_lsit($userId,$start);
if (!empty($circle_reply_lsit['circle_reply_lsit'])) {
    $json_encode = json_encode($circle_reply_lsit, JSON_UNESCAPED_UNICODE);
    $explode = str_replace("null", '""', $json_encode);
    echo $explode;
} else {
    echo '{"indent_history_lsit":[]}';
}
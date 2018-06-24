<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/3
 * Time: 17:25
 */


$userId = UserInfo::getUserId();
$mer_id = $_POST['mer_id'];
$mer_info_class = new mer_info_class();
if ($mer_info_class->attention_status($userId,$mer_id)) {
    echo 1;
    return;
}
echo 0;

<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/10
 * Time: 14:16
 */


ob_start();
$trolley_class = new trolley_class();
$attent_lsit = $trolley_class->attent_lsit(UserInfo::getUserId());
$json_encode = json_encode($attent_lsit, JSON_UNESCAPED_UNICODE);
ob_clean();
if ($attent_lsit['attent_list']) {
    $str_replace = str_replace('null', '""', $json_encode);
    }else{
    $str_replace='{"attent_list":[]}';
}
echo $str_replace;
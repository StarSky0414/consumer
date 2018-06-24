<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/27
 * Time: 18:09
 */
ob_start();
$user_id=UserInfo::getUserId();
$vip_class = new vip_class();
$user_vip_list['vip_list'] = $vip_class->user_vip_list($user_id);
if ($user_vip_list['vip_list']) {
    ob_end_clean();
    echo json_encode($user_vip_list,JSON_UNESCAPED_UNICODE);
    return;
}
ob_end_clean();
echo "{vip_list:[]}";
return;
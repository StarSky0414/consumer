<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/27
 * Time: 16:28
 */

$mer_id='11';
$user_id = UserInfo::getUserId();
$integral='aaa';
$vip_class = new vip_class();
if ($vip_class->vip_upload($mer_id, $user_id,$integral)) {
    echo 1;
    return;
}
echo 0;
return;
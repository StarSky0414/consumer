<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/3
 * Time: 19:57
 */


$pwd = $_POST['pwd'];
$userId = UserInfo::getUserId();
$myself_class = new myself_class();
$change_pwd = $myself_class->change_pwd($userId,$pwd);
if ($change_pwd) {
    echo 1;
    return;
}
echo 0;

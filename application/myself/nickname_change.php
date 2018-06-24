<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/24
 * Time: 22:17
 */

$userId = UserInfo::getUserId();
$photo_path = $_POST['nickname'];
$myself_class = new myself_class();
$nickname_change = $myself_class->nickname_change($userId,$photo_path);
if ($nickname_change){
    echo 1;
    return ;
}
echo 0;
return ;
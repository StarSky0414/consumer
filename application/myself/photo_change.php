<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/24
 * Time: 21:50
 */


$userId = UserInfo::getUserId();
$photo_path = $_POST['photo_path'];
$myself_class = new myself_class();
$photo_change = $myself_class->photo_change($userId,$photo_path);
if ($photo_change){
    echo 1;
    return ;
}
echo 0;
return ;
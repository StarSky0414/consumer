<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 9:53
 */

$mer_id = $_POST['mer_id'];
$content = $_POST['content'];
//$photo_url=array('aaa','bbb');
//$json_encode = json_encode($photo_url, JSON_UNESCAPED_UNICODE);
$photo = $_POST['photo'];
$circle_class = new circle_class();
$user = UserInfo::getUserId();
if ($circle_class->issue($user, $mer_id, $content, $photo)) {
    echo 1;
    return;
}
echo 0;
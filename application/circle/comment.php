<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 11:23
 */

$mer_id=$_POST['mer_id'];
$content=$_POST['content'];
$reply_user=$_POST['reply_user'];
$reply_circle_id=$_POST['reply_circle_id'];

$circle_class = new circle_class();
$user=UserInfo::getUserId();
//$mer_id=4;
//$content='$content';
//$reply_user='44';
if ($circle_class->comment($user,$mer_id,$content,$reply_user,$reply_circle_id)) {
    echo 1;
    return;
}
echo 0;
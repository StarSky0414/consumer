<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 12:33
 */
//ini_set("display_errors", "On");
//error_reporting(E_ALL | E_STRICT);

$attention_by_user1 = $_POST['attention_by_user'];
$attention_user=UserInfo::getUserId();
//$attention_by_user=4;
$circle_class = new circle_class();
echo $circle_class->attention($attention_user,$attention_by_user);
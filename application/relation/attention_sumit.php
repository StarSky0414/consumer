<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 11:05
 */


$attention_by_user_id = $_POST['attention_by_user_id'];
$userId = UserInfo::getUserId();
$relation_class = new relation_class();
if ($relation_class->attention_sumit($attention_by_user_id,$userId)) {
    echo 1;
    return ;
}
echo 0;
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 11:55
 */

$uncollect_mer_id = $_POST['uncollect_mer_id'];
$userId = UserInfo::getUserId();
$relation_class = new relation_class();
if ($relation_class->uncollect_mer_id($uncollect_mer_id,$userId)) {
    echo 1;
    return ;
}
echo 0;
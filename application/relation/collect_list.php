<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 17:10
 */


$userId = UserInfo::getUserId();
$relation_class = new relation_class();
$collect_list['collect_list'] = $relation_class->collect_list($userId);
if (!empty($collect_list['collect_list'])){
    echo json_encode($collect_list,JSON_UNESCAPED_UNICODE);
}else{
    echo '{"collect_list":[]}';
}
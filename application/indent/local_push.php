<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/14
 * Time: 1:46
 */

require_once dirname(__FILE__) . '/../../Tool/Push.php';

//{"k1":"ios","k2":"v2"}
$user_list = $_POST['user_list'];
Push::push_notice('ACCOUNT',$user_list ,null, "{\"type\":\"indent\",\"function\":\"cancel order\",\"reason\":\"overtime\"}", '订单取消通知', '您的订单已自动取消');
//echo "oooo";
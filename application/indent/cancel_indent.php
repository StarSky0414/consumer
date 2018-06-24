<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/15
 * Time: 21:14
 */

ob_start();
require_once dirname(__FILE__) . '/../../Tool/Push.php';
$indent_id = $_POST['indent_id'];
$mer_id = $_POST['mer_id'];
$indent_class = new indent_class();
$indent_class->cancel_indent($indent_id, $mer_id);
Push::push_notice('ACCOUNT', $mer_id, null, "{\"type\":\"indent\",\"function\":\"cancel order\",\"reason\":\"consumer_abolish\"}", '订单取消通知', '您有一个订单被取消');
ob_end_clean();
echo 1;
return;

<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-15
 * Time: 下午11:58
 */

$item_id = $_POST['item_id'];
$userId = UserInfo::getUserId();

$order_class = new order_class();
$item_change = $order_class->item_change($userId, $item_id, 0);
if ($item_change) {
    echo 1;
}else{
    echo 0;
}
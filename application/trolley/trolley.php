<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/7
 * Time: 9:49
 */

if (!isset($_POST['mer_id'])) {
    echo 0;
    return;
}
$mer_id = $_POST['mer_id'];
$trolley_class = new trolley_class();
$classify_select = $trolley_class->classify_select($mer_id);
print_r($classify_select);
//$show_item = $trolley_class->show_item($mer_id);
//print_r($show_item);
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/7
 * Time: 9:55
 */

/**
 * 废弃文件
 */
/*if (!isset($_POST['mer_id'])) {
    echo 0;
    return;
}
ob_start();
$mer_id = $_POST['mer_id'];
$trolley_class = new trolley_class();
$classify_select = $trolley_class->classify_select($mer_id);
foreach ($classify_select as $key => $value) {
//    print_r($value['class_id']);
    $show_item = $trolley_class->show_item($value['class_id']);
    $classify_select[$key] ['item'] = $show_item;
}
//print_r($classify_select);
//ob_end_clean();
$classify_select1['trolley_info'] = $classify_select;
echo json_encode($classify_select1,JSON_UNESCAPED_UNICODE);
//$show_item = $trolley_class->show_item($mer_id);
//print_r($show_item);*/
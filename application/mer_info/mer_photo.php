<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/27
 * Time: 13:49
 */
require_once dirname(__FILE__).'/mer_info_class.php';

//$mer_id=1;
$mer_id = $_POST['mer_id'];
$type = $_POST['type'];
$mer_info_class = new mer_info_class();
$select_type['mer_photo'] = $mer_info_class->select_type($type,$mer_id);
if (empty($select_type['mer_photo'] )){
    echo '{"mer_photo":[]}';
    return;
}
$json_encode = json_encode($select_type, JSON_UNESCAPED_UNICODE);
echo $json_encode;

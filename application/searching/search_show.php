<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/28
 * Time: 10:53
 */
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require_once dirname(__FILE__).'/searching_class.php';
//if (!isset($_POST['small_project'])||!isset($_POST['circle'])||
//    !isset($_POST['city'])||!isset($_POST['rank'])){
//    echo 4;
//    return ;
//}
ob_start();
$small_project = $_POST['small_project'];
$circle = $_POST['circle'];
$city = $_POST['city'];
$rank = $_POST['rank'];
$num_start = $_POST['num_start'];
//$small_project = '聚餐宴请';
//$circle = '全部';
//$city = '大连市';
//$rank = '最新搜录';
//$num_start = 0;
$searching_class = new searching_class();
$select_joint = $searching_class->select_joint($small_project, $circle, $city, $rank, $num_start);
//print_r($select_joint);
ob_end_clean();
$json_encode = json_encode($select_joint, JSON_UNESCAPED_UNICODE);
if ($select_joint['mer_list']){
    $str_replace = str_replace('null', '""', $json_encode);
    echo $str_replace;
}else{
    echo '{"mer_list":[]}';
}
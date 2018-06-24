<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/28
 * Time: 11:28
 */
require_once dirname(__FILE__).'/searching_class.php';

if(!$_POST['city']){
  echo 0;
  return;
}
$city = $_POST['city'];
//$city='大连';
$searching_class = new searching_class();
$show_list = $searching_class->show_list($city);
print_r(json_encode($show_list,JSON_UNESCAPED_UNICODE));
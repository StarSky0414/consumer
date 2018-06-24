<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/15
 * Time: 18:31
 */
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require_once dirname(__FILE__).'/home_page_class.php';

if (!isset($_POST['long'])||!isset($_POST['lat'])){
    $long=121.315057;
    $lat=38.804567;
}else{
    $long=$_POST['long'];
    $lat=$_POST['lat'];
}
$home_page_class = new home_page_class();
$home_page_class->show_classify($long,$lat);
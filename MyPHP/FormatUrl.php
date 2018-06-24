<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/8
 * Time: 16:01
 */
/*
//require dirname(__FILE__).'/../bean/UrlIntent.php';

//echo $_SERVER['REQUEST_URI']."<br>";
$urlIntent = new UrlIntent();
$PHP_SELF = $_SERVER['REQUEST_URI'];   //获得当前请求的网址
//echo $PHP_SELF;
$PHP_SELF = substr($PHP_SELF, 1);   //去掉前‘/’
$explode = explode("/", $PHP_SELF); //进行分割
//echo sizeof($explode);
//======================= 临 时 代 码 ============================
//unset($explode[sizeof($explode)-1]);//临时代码！！！！！
//print_r($explode);
//================================================================
//$member = $urlIntent->getMember();
if(sizeof($explode)>sizeof($member)) {echo '250';retrun ;}  //判断请求网址是否超长

//for ($i = 0; $i<sizeof($explode);$i++){
//    $funName='set'.$member[$i];
//    print_r($funName."<br>");
//    $urlIntent->{$funName}($explode[$i]);
//}
//$project = $urlIntent->getProject();
//print_r($project);*/

class FormatUrl{
    public static function  format_url(){
        $PHP_SELF = $_SERVER['REQUEST_URI'];   //获得当前请求的网址
        $PHP_SELF = substr($PHP_SELF, 1);   //去掉前‘/’
        $explode = explode("/", $PHP_SELF,3); //进行分割
        UrlIntent::setModule($explode[0]);
        UrlIntent::setAction($explode[1]);
        UrlIntent::setBehavior($explode[2]);
        $explode = explode("/", $PHP_SELF);
        return $explode;
    }
}
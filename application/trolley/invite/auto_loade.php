<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午2:30
 */
//////////////////////////////////////////////
require_once dirname(__FILE__).'/../my_redis.php';
/////////////////////////////////////////////

$order = UrlIntent::getBehavior();
$file_name = str_replace('/', '_', $order);
$file_class=UrlIntent::getAction().'_class';
$file_name.='.php';
$file_class_path=dirname(__FILE__).'/'.$file_class.'.php';
$file_name_path=dirname(__FILE__).'/'.$file_name;
//echo "auto_loade.php is loding<br>";
//echo "file_class_path is :$file_class_path <br>";
//echo "file_name_path is :$file_name_path <br>";
if(file_exists($file_class_path)){
//    echo "the class is exist<br>";
    require_once $file_class_path;
}
if(file_exists($file_name_path)){
//    echo "the file is exist<br>";
    require_once $file_name_path;
}

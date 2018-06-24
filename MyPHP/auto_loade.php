<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午6:07
 */


$auto_file_path=dirname(__FILE__).'/../application/'.UrlIntent::getModule().'/'.UrlIntent::getAction().'/auto_loade.php';

$auto_sql_path=$mysql= PATH_SQL.UrlIntent::getModule().'_sql.php';
if(file_exists($auto_file_path)){
    require_once $auto_file_path;
}


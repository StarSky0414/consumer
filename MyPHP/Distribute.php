<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/8
 * Time: 17:37
 */


//require dirname(__FILE__).'/../bean/UrlIntent.php';

class Distribute{
        public   function distribut($explode){
        $module =  $explode[0];
        $action =  $explode[1];
        $behavior='';
        if (isset($explode[2])){
                $behavior='_'.$explode[2];
        }
        define('PATH',dirname(__FILE__).'/../application/');
        define('PATH_SQL',dirname(__FILE__).'/../sql/');
        $application= PATH.$module.'/'.$action.$behavior.'.php';
        $applicationClass=PATH.$module.'/'.$module.'_class.php';
        $application_new=PATH.$module.'/'.$action.'/'.$behavior.'.php';
        $mysql= PATH_SQL.$module.'_sql.php';
        if (file_exists($mysql)){
                include $mysql;
        }
        if (file_exists($applicationClass)){
            include $applicationClass;
        }
        if(file_exists($application)){
            include $application;
        }
        if (file_exists($application_new)){
            include $application_new;
        }

        }
}



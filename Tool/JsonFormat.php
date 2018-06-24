<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/14
 * Time: 14:15
 */

class JsonFormat
{
    public  function jsonFormat($json_array,$name){
        $json_array_new=array();
        foreach ($json_array as $k=>$value){
            $json_array_new[$name]=$value;
        }
        return $json_array_new;
    }
}
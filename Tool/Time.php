<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/10
 * Time: 15:22
 */

class Time
{
    public static function now_time(){
        date_default_timezone_set('PRC');
        $time= date("ymdHis");
        return $time;
    }
}
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/24
 * Time: 16:14
 */

class Random
{
    public static function Random_num($size){
        $st_random='';
        for ($i=0;$i<$size;$i++){
            $st_random=$st_random.(string)rand(0, 9);
        }
        return $st_random;
    }
}
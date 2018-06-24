<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/24
 * Time: 19:09
 */

var_dump(memory_get_usage());
$a = "laruence";
var_dump(memory_get_usage());
unset($a);
var_dump(memory_get_usage());
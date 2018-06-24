<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/17
 * Time: 17:13
 */

require_once dirname(__FILE__).'/mer_info_class.php';
ob_start();
$mer_info_class = new mer_info_class();
$joint = $mer_info_class->joint(1);
ob_end_clean();
echo $joint;
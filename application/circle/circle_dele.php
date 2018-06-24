<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 19:23
 */


$circle_id = $_POST['circle_id'];
$circle_class = new circle_class();
if ($circle_class->circle_dele($circle_id)) {
    echo 1;
    return ;
}
echo 2;
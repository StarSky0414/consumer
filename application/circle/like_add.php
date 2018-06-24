<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/21
 * Time: 19:08
 */

if (!isset($_POST['circle_id'])){
    echo 0;
    return;
}

$circle_id=$_POST['circle_id'];
$circle_class = new circle_class();
if ($circle_class->like_num_add($circle_id)) {
    echo 1;
    return;
}
echo 0;
return;
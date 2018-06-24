<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/10
 * Time: 15:07
 */

$trolley_class = new trolley_class();
$invite_user_id=$_POST['invite_user_id'];
$key_value = $_POST['key_value'];
$user_name = $trolley_class->find_user_name($invite_user_id);
$trolley_class->push($user_name, 'invite', $key_value);

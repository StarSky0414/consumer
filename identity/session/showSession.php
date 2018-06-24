<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/9
 * Time: 21:41
 */


session_status();
echo "This is Session ID: u4m7fjmlu3k72ce9ra14pc4ll0";
echo "<br>";
session_id('u4m7fjmlu3k72ce9ra14pc4ll0');
echo "This is User ID : ";
echo $_SESSION['id'];
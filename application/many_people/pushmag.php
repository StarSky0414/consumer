<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/24
 * Time: 16:32
 */

require_once dirname(__FILE__).'/../../Tool/Push.php';

$account = $_POST['account'];
//$key_value
Push::push_message("ACCOUNT",$account,'');
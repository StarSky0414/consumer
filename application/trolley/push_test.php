<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/11
 * Time: 19:51
 */
require_once dirname(__FILE__).'/../../Tool/Push.php';
$key_value='aaaa';
Push::push_message('ACCOUNT', '22,a,c', "{\"k1\":\"ios\",\"k2\":\"v2\"}", 'delete_room', $key_value);

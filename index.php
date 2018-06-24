<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/8
 * Time: 15:13
 */


ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

define('__KERNEL__',dirname(__FILE__).'/MyPHP/');
require dirname(__FILE__).'/identity/session/SessionVerify.php';
require dirname(__FILE__).'/identity/session/MySession.php';
require dirname(__FILE__).'/bean/UserInfo.php';
require_once dirname(__FILE__).'/bean/UrlIntent.php';
require __KERNEL__.'FormatUrl.php';
require __KERNEL__.'Distribute.php';
$verifySession = SessionVerify::verifySession();
UserInfo::setUserId($verifySession); ///////////////////////////用户id！！！！
if(!$verifySession){
    return ;
}
UserInfo::setUserId( $verifySession);//返回用户id
$format_url = FormatUrl::format_url();
(new Distribute)->distribut($format_url);
require_once dirname(__FILE__).'/MyPHP/auto_loade.php';



<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/9
 * Time: 23:05
 */

class SessionVerify
{

    public static function verifySession(){
        if(SessionOverTime_config::$OVER_TIME!=0){
            if (!isset($_POST['session'])){
                echo 250;
                return false;
            }
            $session = $_POST['session'];
            $mySession = new MySession();
            $read_user_id = $mySession->read_user_id($session);
        }else{
            $read_user_id=1;
        }
        return $read_user_id;
    }
}
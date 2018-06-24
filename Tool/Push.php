<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/21
 * Time: 23:41
 */
require_once dirname(__FILE__).'/../sdk/aliyun-php-sdk-push/Push.php';
class Push
{
    // "{\"k1\":\"android\",\"k2\":\"v2\"}"
    //'ACCOUNT',$room_id,' ',$type,"{\"k1\":\"ios\",\"k2\":\"v2\"}",$type,$body
    public static function push_message($ALL_DEVICE_ACCOUNT_TAG,$device,$key_value,$title='title',$body='body'){
        $push_info = new Push_info();
        $push_info->push('MESSAGE',$ALL_DEVICE_ACCOUNT_TAG,$device," ",$key_value,$title,$body);
        return $push_info;
    }

    public static function push_notice($ALL_DEVICE_ACCOUNT_TAG,$device,$activity,$key_value,$title,$body){
        $push_info = new Push_info();
        $push_info->push('NOTICE',$ALL_DEVICE_ACCOUNT_TAG,$device,$activity,$key_value,$title,$body);
    }
}
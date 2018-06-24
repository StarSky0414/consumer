<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/11
 * Time: 21:27
 */

class UserInfo
{
    private static $user_id;

    /**
     * @return mixed
     */
    public static function getUserId()
    {
        return self::$user_id;
    }

    /**
     * @param mixed $user_id
     */
    public static function setUserId($user_id)
    {
        self::$user_id = $user_id;
    }

}
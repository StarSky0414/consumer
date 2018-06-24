<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/8
 * Time: 15:29
 */

class UrlIntent
{
    private static $_project;
    private static $_module;
    private static $_action;
    private static $_behavior;

    /**
     * @return array
     */


    /**
     * @param array $member
     */
    public static function setMember($member)
    {
        self::$_member = $member;
    }

    /**
     * @return mixed
     */
    public static function getProject()
    {
        return self::$_project;
    }

    /**
     * @param mixed $project
     */
    public static function setProject($project)
    {
        self::$_project = $project;
    }

    /**
     * @return mixed
     */
    public static function getModule()
    {
        return self::$_module;
    }

    /**
     * @param mixed $module
     */
    public static function setModule($module)
    {
        self::$_module = $module;
    }

    /**
     * @return mixed
     */
    public static function getAction()
    {
        return self::$_action;
    }

    /**
     * @param mixed $action
     */
    public static function setAction($action)
    {
        self::$_action = $action;
    }

    /**
     * @return mixed
     */
    public static function getBehavior()
    {
        return self::$_behavior;
    }

    /**
     * @param mixed $behavior
     */
    public static function setBehavior($behavior)
    {
        self::$_behavior = $behavior;
    }



}
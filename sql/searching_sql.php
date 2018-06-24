<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/18
 * Time: 10:58
 */
require_once dirname(__FILE__) . '/MySqlBase.php';

class searching_sql extends MySqlBase
{
    public function joint_result($sql)
    {
        $result = $this->dbHandle->query($sql)->fetchAll();
        return $result;
    }

}
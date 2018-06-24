<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/15
 * Time: 15:26
 */


require_once dirname(__FILE__) . '/MySqlBase.php';

class home_page_sql extends MySqlBase
{
    public function show_mer_info($project_id)
    {
        $sql = 'select  merinfo.mer_id,name,classify,time,grade,longitude,latitude,pho_url  from merinfo,photo_manage where merinfo.mer_id=photo_manage.mer_id and pho_type="surface" and merinfo.project_id=? and pho_del=0 order by mer_id DESC limit 5';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($project_id));
        $result = $PDOStatement->fetchAll();
        return $result;
    }
}
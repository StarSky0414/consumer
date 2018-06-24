<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/26
 * Time: 22:33
 */

class vip_sql extends MySqlBase
{
    public function mer_exist_select_count($mer_id)
    {
        $sql = 'SELECT count(*) FROM mer_VIP_manage WHERE mer_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $count = $PDOStatement->fetch()['count(*)'];
        return $count;
    }

    public function vip_id_conut($user_id)
    {
        $sql = 'SELECT count(*) FROM vip_date WHERE user_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $count = $PDOStatement->fetch()['count(*)'];
        return $count;
    }

    public function vip_upload_inster($vip_date_id, $mer_id, $user_id, $integral)
    {
        $sql = 'INSERT INTO vip_date (vip_date_id,mer_id,user_id,integral) VALUES (?,?,?,?) ';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($vip_date_id, $mer_id, $user_id, $integral));
    }


    public function user_date_id_select($mer_id, $user_id)
    {
        $sql = 'SELECT vip_date_id FROM vip_date WHERE mer_id=? AND user_id=? AND dele_sign=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id, $user_id));
        return $PDOStatement->fetch()['vip_date_id'];
    }

    public function user_integral_update($vip_date_id, $integral)
    {
        $sql = 'UPDATE vip_date SET integral=?+integral WHERE vip_date_id=? AND dele_sign=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($integral, $vip_date_id));
    }

    public function user_vip_list_mer_info_select($mer_id)
    {
        $sql = 'SELECT name,photo,vip_describe,phone FROM merinfo WHERE mer_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        return $PDOStatement->fetch();
    }

    public function user_vip_list_select($user_id)
    {
        $sql = 'SELECT mer_id FROM vip_date WHERE user_id=? AND dele_sign=0 ';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        return $PDOStatement->fetchAll();
    }

    public function user_vip_list_vip_manage_select($integral,$mer_id)
    {
        $sql = 'SELECT VIP_name FROM mer_VIP_manage WHERE min_num < ? AND dele_sign=0 AND mer_id=? ORDER BY min_num DESC LIMIT 0,1';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($integral,$mer_id));
        return $PDOStatement->fetch();
    }

    public function user_vip_list_vip_info_select($user_id,$mer_id)
    {
        $sql = 'SELECT vip_date_id,integral  FROM vip_date WHERE user_id=? AND  mer_id=? AND dele_sign=0 ';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id,$mer_id));
        return $PDOStatement->fetch();
    }

    public function user_discount_grade($integral, $mer_id){
        $sql = 'SELECT VIP_name,discount FROM mer_VIP_manage WHERE min_num < ? AND dele_sign=0 AND mer_id=? ORDER BY min_num DESC LIMIT 0,1';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($integral,$mer_id));
        return $PDOStatement->fetch();
    }



}
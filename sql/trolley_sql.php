<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/6
 * Time: 16:48
 */

class trolley_sql extends MySqlBase
{

    public function user_concern_list($userId)
    {
        $sql = 'select attention_by_user from attention where dele_sign=0 and attention_user=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        $list = $PDOStatement->fetchAll(PDO::FETCH_COLUMN);
        return $list;
    }

    public function user_info($user_concern_id)
    {
        $sql = 'select id,photo,nickname from con_user where con_user.id=? ';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_concern_id));
        $info = $PDOStatement->fetchAll()[0];
        return $info;
    }

    public function user_name_sql($invite_user)
    {
        $sql = 'select con_user.user from con_user where id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($invite_user));
        $result = $PDOStatement->fetch(PDO::FETCH_NUM)[0];
        return $result;
    }

    public function mer_item_info($class_id)
    {
        $sql = 'select item.name,photo,discount,discount_singe,univalence,item_id from item where class_id=? and item.delete_sign=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($class_id));
        $result = $PDOStatement->fetchAll();
        return $result;
    }

    public function mer_class_list($mer_id)
    {
        $sql = 'select class_id,name  from class where user_id=? and delete_sign is null ';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $result = $PDOStatement->fetchAll();
        return $result;
    }

    public function user_vip($mer_id, $userId)
    {
        $sql = 'select VIP_name,discount from mer_VIP_manage where  mer_VIP_manage.min_num<(select integral from vip_date where mer_id=? and user_id=? and vip_date.dele_sign=0) and mer_VIP_manage.dele_sign=0 order by min_num ASC limit 1';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id, $userId));
        $result = $PDOStatement->fetchAll();
        if (empty($result)) {
            return false;
        }
        $VIP_name = $result[0];
        return $VIP_name;
    }

    public function get_user_nickname_sql($userId)
    {
        $sql='select user from con_user where id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        $user = $PDOStatement->fetch()['user'];
        return $user;
    }

    public function find_user_name_sql($user_name_path,$list_id)
    {
        $sql='select id,photo,nickname from con_user where nickname like ? and id>? order by id ASC limit 10';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array("%$user_name_path%",$list_id));
        $result = $PDOStatement->fetchAll();
        return $result;
    }
}
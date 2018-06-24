<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/5
 * Time: 16:36
 */

class indent_sql extends MySqlBase
{

    public function upload_indent_insert($indent_id, $user_id, $mer_id, $trolley_list, $indent_info,$money)
    {
        $sql = 'INSERT  INTO indent (indent_id, user_id, mer_id, trolley_list, indent_info,money) VALUES (?,?,?,?,?,?);';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($indent_id, $user_id, $mer_id, $trolley_list, $indent_info,$money));
    }

    public function max_indent_id_sele()
    {
        $sql = 'SELECT count(*) FROM win.indent ;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute();
        $count = $PDOStatement->fetch()['count(*)'];
        return $count;
    }

    public function find_mer_name_select($mer_id)
    {
        $sql = 'SELECT mer_user FROM meruser WHERE id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $mer_user = $PDOStatement->fetch()['mer_user'];
        return $mer_user;
    }


    public function find_mer_staff_select($mer_id)
    {
        $sql = 'SELECT staff_id FROM mer_staff WHERE mer_id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $mer_user = $PDOStatement->fetchAll();
        return $mer_user;
    }

    public function find_room_user_list_select($room_id)
    {
        $sql = 'SELECT user_id FROM member WHERE dele_sign=0 AND room_id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($room_id));
        $var = $PDOStatement->fetchAll();
        print_r($var);
        return $var;
    }

    public function find_user_name($user_id)
    {
        $sql = 'SELECT user FROM con_user WHERE  id =?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $result = array();
        foreach ($user_id as $item) {
            $PDOStatement->execute(array($item['user_id']));
            $result[] = $PDOStatement->fetch()['user'];
        }
        return $result;
    }

    public function crancel_indent($indent_id, $mer_id)
    {
        $sql = 'UPDATE indent SET type_sign=1, dele_sign=1 WHERE win.indent.indent_id=? AND mer_id=? AND dele_sign=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($indent_id, $mer_id));
    }

    public function unfinsh_indent_select($userId)
    {
        $sql = 'SELECT indent_id , create_time, mer_id ,type_sign,money FROM win.indent WHERE user_id=? AND dele_sign =0 ;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        return $PDOStatement->fetchAll();
    }

    public function find_mer_name($mer_id)
    {
        $sql = 'SELECT name FROM merinfo WHERE mer_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        return $PDOStatement->fetch()['name'];
    }

    public function find_mer_photo($mer_id)
    {
        $sql = 'SELECT photo FROM merinfo WHERE mer_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        return $PDOStatement->fetch()['photo'];
    }

    public function finsh_indent_select($userId)
    {
        $sql = 'SELECT indent_id , create_time, mer_id ,type_sign ,money FROM win.indent WHERE user_id=? AND dele_sign =1 ;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        return $PDOStatement->fetchAll();
    }

    public function indent_info_select($indent_id)
    {
        $sql='select mer_id,create_time,money,trolley_list,type_sign FROM  win.indent WHERE indent_id=? ;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($indent_id));
        $var = $PDOStatement->fetch();
        return $var;
    }


}
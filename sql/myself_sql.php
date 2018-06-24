<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/16
 * Time: 11:19
 */

class myself_sql extends MySqlBase
{

    public function user_info($user_id)
    {
        $sql = 'SELECT nickname,exp,photo FROM con_user WHERE dele_sign=0 AND id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $var = $PDOStatement->fetch();
        return $var;
    }

    public function attention_to_me($user_id)
    {
        $sql = 'SELECT count(*) FROM attention WHERE dele_sign=0 AND attention.attention_by_user=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $var = $PDOStatement->fetch()['count(*)'];
        return $var;
    }

    public function me_to_attention($user_id)
    {
        $sql = 'SELECT count(*) FROM attention WHERE dele_sign=0 AND attention_user=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $var = $PDOStatement->fetch()['count(*)'];
        return $var;
    }

    public function comment_num($user_id)
    {
        $sql = 'SELECT count(*) FROM circle WHERE dele_sign=0 AND user_id=? AND reply_user!=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $var = $PDOStatement->fetch()['count(*)'];
        return $var;
    }

    public function indent_num($user_id)
    {
        $sql = 'SELECT count(*) FROM win.indent WHERE user_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $var = $PDOStatement->fetch()['count(*)'];
        return $var;
    }

    public function photo_change_sql($userId, $photo_path)
    {
        $sql = 'UPDATE con_user SET photo=? WHERE  id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($photo_path, $userId));
    }

    public function nickname_change_sql($userId, $nickname)
    {
        $sql = 'UPDATE con_user SET nickname=? WHERE  id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($nickname, $userId));
    }

    public function indent_history_lsit($userId, $start)
    {
        $sql = 'SELECT indent_id,indent.mer_id,name,photo,create_time,type_sign,money FROM win.indent ,merinfo WHERE indent.user_id=? AND indent.mer_id=merinfo.mer_id ORDER BY create_time DESC LIMIT ' . $start . ',10';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        $result_list = $PDOStatement->fetchAll();
        return $result_list;
    }

    public function circle_reply_lsit_select($userId, $start)
    {
        $sql = 'SELECT reply_circle_id,circle_id,content,reply_user FROM circle WHERE user_id=? AND dele_sign=0 AND reply_user!=0 ORDER BY create_time DESC LIMIT ' . $start . ',10';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        $result_list = $PDOStatement->fetchAll();
        return $result_list;
    }

    public function get_nickname($reply_user)
    {
        $sql = 'SELECT nickname FROM con_user WHERE user=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($reply_user));
        $mickname = $PDOStatement->fetch()['mickname'];
        return $mickname;
    }

    public function get_publish_photo($reply_circle_id)
    {
        $sql = 'SELECT pho_url FROM photo_manage WHERE pho_type=\'issue\' AND con_project_id =?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($reply_circle_id));
        $pho_url = $PDOStatement->fetch()['pho_url'];
        return $pho_url;
    }

    public function change_pwd_update($userId, $pwd)
    {
        $sql = 'UPDATE con_user SET password=? WHERE id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($pwd, $userId));
    }

}
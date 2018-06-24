<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 11:02
 */

class relation_sql extends MySqlBase
{

    public function attention_sumit_inster($attention_by_user_id, $userId)
    {
        $sql = 'INSERT INTO attention (attention_user, attention_by_user) VALUES (?,?)';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($userId, $attention_by_user_id));

    }

    public function unattention_sumit_update($unattention_by_user_id, $userId)
    {
        $sql = 'UPDATE attention SET dele_sign=1 WHERE attention_user=?AND attention_by_user=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($userId, $unattention_by_user_id));
    }

    public function collect_mer_id_inster($collect_mer_id, $userId)
    {
        $sql = 'INSERT INTO collect_mer (collect_user,collect_by_mer ) VALUES (?,?)';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($userId, $collect_mer_id));
    }

    public function uncollect_mer_id_inster($uncollect_mer_id, $userId)
    {
        $sql = 'UPDATE collect_mer SET dele_sign=1 WHERE collect_user=?AND collect_by_mer=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($userId, $uncollect_mer_id));
    }

    public function collect_list($userId)
    {
        $sql = 'select mer_id,name,photo from collect_mer,merinfo WHERE collect_by_mer=mer_id AND collect_user=? and dele_sign=0';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId));
        $result_list = $PDOStatement->fetchAll();
        return $result_list;
    }
}
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/4/2
 * Time: 11:00
 */

class relation_class
{
    private $relation_sql;

    public function __construct()
    {
        $this->relation_sql = new relation_sql();
    }


    public function attention_sumit($attention_by_user_id, $userId)
    {
        $this->unattention_by_user_id($attention_by_user_id, $userId);
        $attention_sumit_inster = $this->relation_sql->attention_sumit_inster($attention_by_user_id, $userId);
        return $attention_sumit_inster;
    }

    public function unattention_by_user_id($unattention_by_user_id, $userId)
    {
        $unattention_sumit_inster = $this->relation_sql->unattention_sumit_update($unattention_by_user_id, $userId);
        return $unattention_sumit_inster;
    }

    public function collect_mer_id($collect_mer_id, $userId)
    {
        $this->uncollect_mer_id($collect_mer_id, $userId);
        $collect_mer_id_inster = $this->relation_sql->collect_mer_id_inster($collect_mer_id, $userId);
        return $collect_mer_id_inster;
    }

    public function uncollect_mer_id($uncollect_mer_id, $userId)
    {
        $uncollect_mer_id_update = $this->relation_sql->uncollect_mer_id_inster($uncollect_mer_id, $userId);
        return $uncollect_mer_id_update;
    }

    public function collect_list($userId)
    {
        $collect_list = $this->relation_sql->collect_list($userId);
        return $collect_list;
    }


}
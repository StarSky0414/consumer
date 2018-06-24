<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-13
 * Time: 下午8:00
 */

class invite_class
{
    private $trolley_sql;

    public function __construct()
    {
        $this->trolley_sql = $trolley_sql = new trolley_sql();
    }

    public function user_concern($userId){
        $user_concern_list_info['user_concern_list_info']=array();
        $user_concern_list = $this->trolley_sql->user_concern_list($userId);
        foreach ($user_concern_list as $user_concern_id){
            $user_concern_list_info['user_concern_list_info'][] = $this->trolley_sql->user_info($user_concern_id);
        }
        return $user_concern_list_info;
    }

    public function find_user( $find_user_id)
    {
        $user_info = $this->trolley_sql->user_info($find_user_id);
        return $user_info;
    }

    public function user_name($invite_user)
    {
        $user_name_sql = $this->trolley_sql->user_name_sql($invite_user);
        return $user_name_sql;
    }

    public function find_user_name($user_name_path,$list_id)
    {
        $user_name_sql = $this->trolley_sql->find_user_name_sql($user_name_path,$list_id);
        return $user_name_sql;
    }

}
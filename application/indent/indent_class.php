<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/5
 * Time: 16:35
 */

class indent_class
{
    private $indent_sql;

    public function __construct()
    {
        $this->indent_sql = new indent_sql();
    }

    public function upload_indent($user_id, $mer_id, $trolley_list, $indent_info,$money)
    {
        $max_indent_id = $this->max_indent_id();
        $max_indent_id++;
        $indent_id = $mer_id . '0' . $user_id . '0' . $max_indent_id;
        $upload_indent_insert = $this->indent_sql->upload_indent_insert($indent_id, $user_id, $mer_id, $trolley_list, $indent_info,$money);
        if ($upload_indent_insert){
            return $indent_id;
        }else{
            return false;
        }
    }

    private function max_indent_id()
    {
        $max_indent_id_sele = $this->indent_sql->max_indent_id_sele();
        return $max_indent_id_sele;
    }

    private function find_mer_staff($mer_id)
    {
        $mer_staff_select = $this->indent_sql->find_mer_staff_select($mer_id);
        $list=array();
        foreach ($mer_staff_select as $item) {
            $list[]=$item['staff_id'];
        }
        $implode = implode(',', $list);
        return $implode;
    }

    public function find_mer_name_list($mer_id)
    {
        $mer_name = $this->indent_sql->find_mer_name_select($mer_id);
        $mer_staff = $this->find_mer_staff($mer_id);
        $push_list=$mer_staff.','.$mer_name;
        return $push_list;
    }

    public function find_room_user_list($room_id)
    {
        $room_user_list_select = $this->indent_sql->find_room_user_list_select($room_id);
        $user_name = $this->indent_sql->find_user_name($room_user_list_select);
        return $user_name;
    }

    public function cancel_indent($indent_id,$mer_id){
        $this->indent_sql->crancel_indent($indent_id,$mer_id);
    }

    public function unfinish_indent($userId)
    {
        $unfinsh_indent_select = $this->indent_sql->unfinsh_indent_select($userId);
//        print_r($unfinsh_indent_select);
        if (empty($unfinsh_indent_select)){
            return $unfinsh_indent_select;
        }
        foreach ($unfinsh_indent_select as $key=> $item){
            $mer_id = $item['mer_id'];
            $mer_name = $this->indent_sql->find_mer_name($mer_id);
            $unfinsh_indent_select[$key]['mer_name']=$mer_name;
        }
        return $unfinsh_indent_select;
    }

    public function finish_indent($userId)
    {
        $unfinsh_indent_select = $this->indent_sql->finsh_indent_select($userId);
//        print_r($unfinsh_indent_select);
        if (empty($unfinsh_indent_select)){
            return $unfinsh_indent_select;
        }
        foreach ($unfinsh_indent_select as $key=> $item){
            $mer_id = $item['mer_id'];
            $mer_name = $this->indent_sql->find_mer_name($mer_id);
            $mer_photo = $this->indent_sql->find_mer_photo($mer_id);
            $unfinsh_indent_select[$key]['mer_name']=$mer_name;
            $unfinsh_indent_select[$key]['photo']=$mer_photo;
        }
        return $unfinsh_indent_select;
    }


    public function indent_info($indent_id)
    {
        $indent_info_select = $this->indent_sql->indent_info_select($indent_id);
        if (!empty($indent_info_select)){
            $mer_name = $this->indent_sql->find_mer_name($indent_info_select['mer_id']);
            $indent_info_select['mer_name']=$mer_name;
            $indent_info_select['trolley_list'] = json_decode($indent_info_select['trolley_list']);
        }
        return $indent_info_select;

    }


}
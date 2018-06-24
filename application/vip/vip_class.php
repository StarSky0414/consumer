<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/26
 * Time: 22:33
 */

class vip_class{
    private $vip_sql;

    public function __construct()
    {
        $this->vip_sql = new vip_sql();
    }

    public function mer_exist($mer_id){
        $mer_exist_select_count = $this->vip_sql->mer_exist_select_count($mer_id);
        return $mer_exist_select_count?true:false;
    }

    public function vip_upload($mer_id, $user_id,$integral){
        if ($this->mer_exist($mer_id)) {
            $vip_id_conut = $this->vip_sql->vip_id_conut($user_id);
            $next_id=$vip_id_conut+1;
            $vip_date_id=$mer_id.'0'.$user_id.'0'.$next_id;
            if ($this->vip_sql->vip_upload_inster($vip_date_id,$mer_id,$user_id,$integral)) {
                return 1;
            }
        }
        return 0;
    }

    public function user_vip($mer_id, $user_id, $integral){
        $user_date_id_select = $this->vip_sql->user_date_id_select($mer_id, $user_id);
        if ($user_date_id_select){
             $user_integral_update = $this->vip_sql->user_integral_update($user_date_id_select, $integral);
             return $user_integral_update;
        }else{
            return $this->vip_upload($mer_id, $user_id,$integral);
        }
    }

    public function user_vip_list($user_id){
        $user_vip_list_select = $this->vip_sql->user_vip_list_select($user_id);
        foreach ( $user_vip_list_select as $key=> $mer_id){
//            $user_vip_list_select[$key]='';
            $user_vip_list_mer_info_select = $this->vip_sql->user_vip_list_mer_info_select($mer_id['mer_id']);
            $user_vip_list_vip_info_select = $this->vip_sql->user_vip_list_vip_info_select($user_id, $mer_id['mer_id']);
            $user_vip_list_vip_manage_select = $this->vip_sql->user_vip_list_vip_manage_select($user_vip_list_vip_info_select['integral'],$mer_id['mer_id']);
            if (!$user_vip_list_vip_manage_select){
                $user_vip_list_vip_manage_select=array("VIP_name" => "");
            }
            $array_merge[$key] = array_merge($user_vip_list_select[$key], $user_vip_list_mer_info_select,$user_vip_list_vip_info_select,$user_vip_list_vip_manage_select);
        }
        return $array_merge;
    }

    public function vip_discount($user_id,$mer_id){
        $integral = $this->vip_sql->user_vip_list_vip_info_select($user_id, $mer_id)['integral'];
        $user_discount_grade = $this->vip_sql->user_discount_grade($integral, $mer_id);
//        $discount = $user_discount_grade['discount'];
//        $item_list = $user_discount_grade['item_list'];
        return $user_discount_grade;
    }
}
<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-14
 * Time: 上午9:08
 */

class create_class
{
    private $trolley_sql;

    public function __construct()
    {
        $this->trolley_sql = $trolley_sql = new trolley_sql();
    }

    public function create_room($mer_id, $userId)
    {
        $user_vip = $this->trolley_sql->user_vip($mer_id, $userId);
        if ($user_vip) {
            $VIP_name = $user_vip['VIP_name'];
            $discount = $user_vip['discount'];
        } else {
            $VIP_name = "";
            $discount = "";
        }
        $mer_item['mer_item'] = $this->mer_item($mer_id);
        $mer_item['discount'] = $discount;
        $mer_item['VIP_name'] = $VIP_name;
        return $mer_item;
    }

    public function make_room_id()
    {
        $md5 = md5(uniqid(md5(microtime(true))));
        return $md5;
    }

    private function mer_item($mer_id)
    {
        $mer_item_list = array();
        $mer_class_list = $this->trolley_sql->mer_class_list($mer_id);
        foreach ($mer_class_list as $key => $item) {
            $mer_item_list[$key]['class_name'] = $item['name'];
            $mer_item_list[$key]['item_info'] = $this->trolley_sql->mer_item_info($item['class_id']);
        }
        return $mer_item_list;
    }

}
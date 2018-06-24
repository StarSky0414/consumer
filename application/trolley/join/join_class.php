<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-15
 * Time: 上午12:40
 */

class join_class
{
    private $trolley_sql;

    private $my_redis;

    public function __construct()
    {
        $this->trolley_sql = $trolley_sql = new trolley_sql();
        $this->my_redis = $my_redis = new my_redis();
    }

    public function mer_item($mer_id)
    {
        $mer_item_list = array();
        $mer_class_list = $this->trolley_sql->mer_class_list($mer_id);
        foreach ($mer_class_list as $key => $item) {
            $mer_item_list[$key]['class_name'] = $item['name'];
            $mer_item_list[$key]['item_info'] = $this->trolley_sql->mer_item_info($item['class_id']);
        }
        return $mer_item_list;
    }

    public function item_add_num($mer_item, $item)
    {

            foreach ($mer_item as $key => $item_info) {
                foreach ($item_info['item_info'] as $k => $value) {
                    if (!isset($mer_item[$key]['item_info'][$k]['num'])) {
                        $mer_item[$key]['item_info'][$k]['num'] = '0';
                    }
                    foreach ($item as $item_value) {
                    if ($value['item_id'] == $item_value) {
                        $item_value=next($item);
                        print_r($item_value);
                        if ($item_value == '1') {
                            $mer_item[$key]['item_info'][$k]['num'] = (string)($mer_item[$key]['item_info'][$k]['num'] + 1);
                        } else {
                            $mer_item[$key]['item_info'][$k]['num'] = (string)($mer_item[$key]['item_info'][$k]['num'] - 1);
                        }
                        next($item);
                        next($item);
                    }
                }
            }
        }
        return $mer_item;
    }

    private function vip($mer_id, $userId, $join_list)
    {
        $user_vip = $this->trolley_sql->user_vip($mer_id, $userId);
        if ($user_vip) {
            $VIP_name = $user_vip['VIP_name'];
            $discount = $user_vip['discount'];
        } else {
            $VIP_name = "";
            $discount = "";
        }
        $join_list['VIP_name'] = $VIP_name;
        $join_list['discount'] = $discount;
        return $join_list;
    }

    public function json_array_list($user_id)
    {
        $join_room = $this->my_redis->join_room($user_id);
        //
        $house_owner = $join_room['house_owner'];
        $timestamp = $join_room['timestamp'];
        $mer_id = $join_room['mer_id'];
        $version_num = $join_room['version_num'];
        $room_id = $join_room['room_id'];
        //
        $mer_item = $this->mer_item($mer_id);
        $item = $this->my_redis->synchronization($room_id, 1, $version_num * 3);
        $item_add_num = $this->item_add_num($mer_item, $item);
        $house_owner_nickname = $this->get_user_nickname($house_owner);
        $join_array_list['order_status'] = true;
        $join_array_list['mer_item'] = $item_add_num;
        $join_array_list = $this->vip($mer_id, $house_owner, $join_array_list);
        $join_array_list['timestamp'] = date('Y-m-d H:i:s', $timestamp);
        $join_array_list['this_version_number'] = $version_num;
        $join_array_list['house_owner_nickname'] = $house_owner_nickname;
        $member_list = $this->my_redis->member_list($user_id);
        $join_array_list['member']=[];
        foreach ($member_list as $value){
            $user_nickname = $this->get_user_nickname($value);
            $join_array_list['member'][] =$user_nickname;
        }
        return $join_array_list;
    }
    public function get_user_nickname($userId)
    {
        $user_nickname_sql = $this->trolley_sql->get_user_nickname_sql($userId);
        return $user_nickname_sql;
    }

}
<?php
/**
 * 用一颗平常心，面对一个不平常的工作!
 * Created by PhpStorm.
 * User: luojunyuan
 * Date: 18-4-14
 * Time: 上午9:26
 */

class my_redis
{
    private $redis;
    private $key_trolley = "sweet:trolley:list:hashmap";
//    private $key_invite="sweet:invite:list:hashmap";
    private $key_room_head = "sweet:trolley:room:list:";
    private $key_SHA_head = "sweet:trolley:lua_function_SHA:hashmap";

    public function __construct()
    {
        $redis = new Redis();
        $this->redis = $redis;
        $this->redis->connect('127.0.0.1', '6379');
    }


    private function getSHANumber($lua_file_name)
    {
        $SHA_number = $this->redis->hGet($this->key_SHA_head, $lua_file_name);
        if ($this->redis->script('EXISTS', $SHA_number)[0] == 0) {
            $SHA_number = $this->setSHANumber($lua_file_name);
        }
        return $SHA_number;
    }

    private function setSHANumber($function_name)
    {
        $PATH = dirname(__FILE__) . '/../../Lua/' . $function_name . '.lua';
        $fopen = fopen($PATH, 'r');
        $fread = fread($fopen, filesize($PATH));
        $script = $this->redis->script('load', $fread);
        $this->redis->hSet($this->key_SHA_head, $function_name, $script);
        return $script;
    }

    public function create_room($room_id, $house_owner, $mer_id, $timestamp)
    {
        $SHANumber = $this->getSHANumber('create_room');
        $lua_result = $this->redis->evalSha($SHANumber, [$room_id, $house_owner, $mer_id, $timestamp], 4);
        if ($lua_result) {
            return true;
        } else {
            return false;
        }
    }

    public function invite_list_hashmap($userId, $invite_user)
    {
        $SHANumber = $this->getSHANumber('invite');
        $lua_result = $this->redis->evalSha($SHANumber, [$userId, $invite_user], 2);
        if ($lua_result) {
            return true;
        } else {
            return false;
        }
    }

    public function get_room_id($userId)
    {
        $SHANumber = $this->getSHANumber('get_room_id');
        $lua_result = $this->redis->evalSha($SHANumber, [$userId], 1);
        if ($lua_result) {
            return $lua_result;
        } else {
            return false;
        }
    }


    public function get_version_num($room_id)
    {
        $SHANumber = $this->getSHANumber('join_room_version_num');
        $lua_result = $this->redis->evalSha($SHANumber, [$room_id], 1);
        return $lua_result?$lua_result:"";
    }

    private function get_room_info($room_id, $user_id)
    {
        $SHANumber = $this->getSHANumber('join_room_room_info');
        $lua_result = $this->redis->evalSha($SHANumber, [$room_id, $user_id], 2);
        if (!$lua_result) {
            return false;
        }
        return $lua_result;
    }

    public function join_room($userId)
    {
        $room_id = $this->get_room_id($userId);
        if (!$room_id) {
            return false;
        }
        $version_num = $this->get_version_num($room_id);
        $mer_info = $this->get_room_info($room_id, $userId);
        if (!$version_num || !$mer_info) {
            return false;
        }
        $result_array = array();
        for ($i = 0; $i <6; $i+=2) {
            $result_array[$mer_info[$i]]=$mer_info[($i+1)];
        }
        $result_array['version_num']=$version_num;
        $result_array['room_id']=$room_id;
        return $result_array;
    }

    public function synchronization($room_id, $start, $stop){
        $SHANumber = $this->getSHANumber('synchronization');
        $lua_result = $this->redis->evalSha($SHANumber, [$room_id, $start,$stop], 3);
        if (!$lua_result) {
            return [];
        }
        return $lua_result;
    }

    public function item_change($user_id, $user_nickname, $item_id,$operate)
    {
        $room_id = $this->get_room_id($user_id);
        $SHANumber = $this->getSHANumber('item_change');
        $evalSha = $this->redis->evalSha($SHANumber, [$room_id, $user_nickname, $item_id, $operate],4);
        if ($evalSha){
            return true;
        }else{
            return false;
        }
    }

    public function member_list($user_id){
        $room_id = $this->get_room_id($user_id);
        $SHANumber = $this->getSHANumber('member_list');
        $evalSha = $this->redis->evalSha($SHANumber, [$room_id],1);
        return $evalSha;
    }

    public function close_user($userId,$close_id_array)
    {
        $room_id = $this->get_room_id($userId);
        $SHANumber = $this->getSHANumber('close_list');
        $evalSha = $this->redis->evalSha($SHANumber, array_merge([$room_id],$close_id_array),1);
        return $evalSha;
    }

    public function get_house_owner_id($user_id){
        $room_id = $this->get_room_id($user_id);
        $house_owner = $this->redis->hGet("sweet:trolley:room:info:$room_id:hashmap",'house_owner');
        return $house_owner;
    }
}
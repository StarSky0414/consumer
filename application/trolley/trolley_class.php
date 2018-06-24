<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/6
 * Time: 16:47
 */
require_once dirname(__FILE__) . '/../../Tool/Push.php';

class trolley_class
{
    private $trolley_sql;

    private $redis;

    public function __construct()
    {
        $this->trolley_sql = new trolley_sql();
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', '6379');
    }

    public function classify_select($user_id)
    {
        $classify_select = $this->trolley_sql->classify_select($user_id);
        return $classify_select;
    }

    public function show_item($class_id)
    {
        $show_item = $this->trolley_sql->item_select($class_id);
        return $show_item;
    }

/*    public function creat_room($mer_id, $room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hSetNx = $this->redis->hSetNx($key, 'password', '');
        $this_mer = $hSetNx ? $this->this_mer($mer_id, $room_id) : $hSetNx;
        $expire = $this_mer ? $this->redis->expire($key, 1800) : $this_mer;
        return $expire;
    }*/

    public function this_mer($mer_id, $room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hSetNx = $this->redis->hSetNx($key, 'mer_id', $mer_id);
        return $hSetNx;
    }

    public function get_mer_id($room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hSetNx = $this->redis->hGet($key, 'mer_id');
        return $hSetNx;
    }

    public function create_room($mer_id, $room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
//        print_r($hGet . '----------'.$oldpassword);
        if (!$this->redis->hGet($key, 'mer_id')) {
            $this_mer = $this->this_mer($mer_id, $room_id);
//            $this_mer ? $this->redis->expire($key, 1800) : null;
            return true;
        }
        return false;
    }

    public function update_menu($room_id, $item, $incr_decr)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hIncrBy = $this->redis->hIncrBy($key, $item, $incr_decr);
        if ($hIncrBy < 0 || $hIncrBy == 0) {
            $this->redis->hDel($key, $item);
            return 0;
        }
//        $this->push($room_id,)///////???????????????
        return $hIncrBy;
    }

    public function pw_ver($room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hGet = $this->redis->hGet($key, 'mer_id');
        if (!empty($hGet)) {
            return true;
        }
        return false;
    }

    public function show_menu($room_id)
    {
        $key = "sweet:trolley:menue:$room_id:map";
        $hGetAll = $this->redis->hGetAll($key);
        return $hGetAll;
    }

    /*    public function spop_pool()
        {
            $sPop = $this->redis->sPop('sweet:indent:pool:set');
            return $sPop;
        }*/

    public function confirm($room_id)
    {
        $list = array();
        $key = "sweet:trolley:menue:$room_id:map";
        $hGetAll = $this->redis->hGetAll($key);
//        unset($hGetAll['password']);
//        unset($hGetAll['mer_id']);
        $i = 0;
        foreach ($hGetAll as $item_name => $num) {
            $list[$i]['name'] = $this->trolley_sql->item_name($item_name);
            $list[$i]['num'] = $num;
            $i++;
        }
        $item_list['item_list'] = $list;
        return $item_list;
    }

    public function push($user_list, $title, $body)
    {
        Push::push_message('ACCOUNT', $user_list, "{\"k1\":\"ios\",\"k2\":\"v2\"}", $title, $body);
    }

    public function attent_lsit($user_id)
    {
        $attent_list_sele['attent_list'] = $this->trolley_sql->attent_list_sele($user_id);
        return $attent_list_sele;
    }

    public function attent_find($find_user_id)
    {
        $attent_find_sele = $this->trolley_sql->attent_find_sele($find_user_id);
        return $attent_find_sele;
    }

    public function find_user_id($find_user_name)
    {
        $find_id_sele = $this->trolley_sql->find_id_sele($find_user_name);
        return $find_id_sele;
    }

    public function member_join($user_id, $room_id)
    {
        $member_join_sele = $this->trolley_sql->member_join_sele($user_id, $room_id);
        return $member_join_sele;
    }

    public function find_room_user_list($room_id)
    {
        $room_user_list_select = $this->trolley_sql->find_room_user_list_select($room_id);
        $user_name = $this->trolley_sql->find_user_name($room_user_list_select);
        return $user_name;
    }

    public function find_user_name($user)
    {
        return $this->trolley_sql->find_user_name_sele($user);
    }

    public function nickname_find($name_part,$start)
    {
        $nickname_find_select = $this->trolley_sql->nickname_find_select($name_part,$start);
        return $nickname_find_select;
    }

}
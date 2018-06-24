<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/17
 * Time: 15:04
 */
require_once dirname(__FILE__) . '/../../sql/mer_info_sql.php';

class mer_info_class
{
    private $_table_photo = 'photo_manage';
    private $_field_photo_mer_id = 'mer_id';
    private $_field_photo_pho_name = 'pho_name';
    private $_field_photo_pho_type = 'pho_type';
    private $_field_photo_pho_url = 'pho_url';
    private $_field_photo_del = 'pho_del';

    private $mer_info_sql;

    public function __construct()
    {
        $this->mer_info_sql = new mer_info_sql();
    }

    private function recommend_show($mer_id)
    {
        $pho_type = 'recommend';
        $select_sql = array($this->_field_photo_pho_url);
        $where_sql = array($this->_field_photo_mer_id => $mer_id, $this->_field_photo_del => 0, $this->_field_photo_pho_type => $pho_type);
        $order = $this->_field_photo_pho_name;
        $select_order_0_3 = $this->mer_info_sql->select_order_0_3($this->_table_photo, $select_sql, $where_sql, $order);
        $photo_array = array();
        if ($select_order_0_3) {
            foreach ($select_order_0_3 as $k => $v) {
                $photo_array[$pho_type][$k] = $v['pho_url'];
            }
            return $photo_array;
//            echo json_encode($photo_array,JSON_UNESCAPED_UNICODE);
        }
    }

    public function environment_show($mer_id)
    {
        $pho_type = 'environment';
        $select_sql = array($this->_field_photo_pho_url);
        $where_sql = array($this->_field_photo_mer_id => $mer_id, $this->_field_photo_del => 0, $this->_field_photo_pho_type => $pho_type);
        $order = $this->_field_photo_pho_name;
        $select_order_0_3 = $this->mer_info_sql->select_order_0_3($this->_table_photo, $select_sql, $where_sql, $order);
        $photo_array = array();
        if ($select_order_0_3) {
            foreach ($select_order_0_3 as $k => $v) {
                $photo_array[$pho_type][$k] = $v['pho_url'];
            }
//            print_r($photo_array);
//            echo json_encode($photo_array,JSON_UNESCAPED_UNICODE);
            return $photo_array;
        }
    }

    public function surface_show($mer_id)
    {
        $pho_type = 'surface';
        $select_sql = array($this->_field_photo_pho_url);
        $where_sql = array($this->_field_photo_mer_id => $mer_id, $this->_field_photo_del => 0, $this->_field_photo_pho_type => $pho_type);
        $order = $this->_field_photo_pho_name;
        $select_order_0_3 = $this->mer_info_sql->select_order_0_3($this->_table_photo, $select_sql, $where_sql, $order);
        $photo_array = array();
        if ($select_order_0_3) {
            foreach ($select_order_0_3 as $k => $v) {
                $photo_array[$pho_type][$k] = $v['pho_url'];
            }
//            print_r($photo_array);
//            echo json_encode($photo_array,JSON_UNESCAPED_UNICODE);
            return $photo_array;
        }
    }

    private function mer_info_show($mer_id)
    {
        $select_sql = array('name', 'classify', 'introduce', 'phone', 'address', 'business_hours',
            'status', 'reserve', 'avecon', 'time', 'grade', 'longitude', 'latitude');
        $where_sql = array('mer_id' => $mer_id);
        if ($result = $this->mer_info_sql->select('merinfo', $select_sql, $where_sql)) {
//            print_r($result);
            return $result;
//            echo json_encode($result,JSON_UNESCAPED_UNICODE);
        }
    }

    private function circle_show($mer_id)
    {
        return null;
    }

    public function joint($mer_id)
    {

        $surface_show = $this->surface_show($mer_id)['surface'][0];
        $recommend_show = $this->recommend_show($mer_id);
        $environment_show = $this->environment_show($mer_id);
        $mer_info_show = $this->mer_info_show($mer_id)[0];
        $circle_show = $this->circle_show($mer_id);
        $joint['info']['surface'] = $surface_show;

        $this->josn_format($recommend_show, $joint['info']);
        $this->josn_format($environment_show, $joint['info']);
//        $joint['info'][1]=$recommend_show;
//        $joint['info'][2]=$environment_show;
        $this->josn_format($mer_info_show, $joint['info']['shopdes']);
        $joint['circle'] = $circle_show;
        print_r($joint);
        return json_encode($joint, JSON_UNESCAPED_UNICODE);
    }

    private function josn_format($json_arr, &$json_result)
    {
        foreach ($json_arr as $key => $value) {
            $json_result[$key] = $value;
        }
    }

    public function select_type($type,$mer_id)
    {
        $item=array();
        switch ($type) {
            case "1"://菜品
                $item = $this->mer_info_sql->item_show_select($mer_id);
                break;
            case "2"://环境
                $item=$this->mer_info_sql->environment_show_select($mer_id);
                break;
        }
        return $item;
    }

    public function attention_status($userId,$mer_id){
        $attention_status_count = $this->mer_info_sql->attention_status_count($userId, $mer_id);
        return $attention_status_count;
    }
}
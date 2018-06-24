<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/17
 * Time: 15:18
 */
require_once dirname(__FILE__) . '/MySqlBase.php';

class mer_info_sql extends MySqlBase
{
    public function select_order_0_3($table_name, $select_array, $where_array, $order)
    {
        $select = "select ";
        $table = " from ";
        if (is_array($table_name)) {
            $table .= implode(',', $table_name);
        } else {
            $table .= $table_name;
        }
        $where = " where 1=1 ";
        $array_values = array_values($select_array);
        $select .= implode(',', $array_values);
        if (isset($where_array)) {
            $where_key = array_keys($where_array);
            $where_value = $this->type_change(array_values($where_array));
            $where_array = array_combine($where_key, $where_value);
            foreach ($where_array as $k => $v) {
                $where .= ' and ' . $k . '=' . $v;
            }
        }
        $sql = $select . $table . $where . "order by $order ASC limit 0,3;";
        echo $sql;
        return $this->dbHandle->query($sql)->fetchAll();//返回查询结果的数组
    }

    public function item_show_select($mer_id)
    {
        $sql = 'select item.photo from item ,class WHERE  item.delete_sign=0 AND user_id=? AND item.class_id=class.class_id;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $var = $PDOStatement->fetchAll();
        $list=array();
        foreach ($var as $item){
//            print_r($item);
            $list[]=$item['photo'];
        }
//        print_r($list);
        return $list;
    }

    public function environment_show_select($mer_id){
        $sql = 'select pho_url from photo_manage WHERE  pho_del=0 AND mer_id=? AND pho_type="environment";';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $var = $PDOStatement->fetchAll();
        $list=array();
        foreach ($var as $item){
            $list[]=$item['pho_url'];
        }
        return $list;
    }

    public function attention_status_count($userId,$mer_id){
        $sql='select count(*) from collect_mer WHERE dele_sign=0 AND collect_mer.collect_user=? AND collect_mer.collect_by_mer=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($userId,$mer_id));
        $result = $PDOStatement->fetch()['count(*)'];
        return $result;
    }
}
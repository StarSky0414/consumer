<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/16
 * Time: 11:39
 */
require_once dirname(__FILE__) . '/MySqlBase.php';

class Photo_tool_sql extends MySqlBase
{
    private $TABLE = 'photo_manage';
    private $field_mer_id = 'mer_id';
    private $field_pho_name = 'pho_name';
    private $field_pho_type = 'pho_type';
    private $field_pho_url = 'pho_url';

    public function max_photo_name($mer_id, $pho_type)
    {
        $sql = "SELECT max( pho_name ) FROM photo_manage WHERE pho_type=? AND mer_id= ? ;";
        $mysql = $this->dbHandle->prepare($sql);
        $param_array = array( $pho_type, $mer_id);
        $mysql->execute($param_array);
//        print_r();
        return $mysql->fetch()['max( pho_name )'];
    }

    public function insert_photo($mer_id,$pho_name,$pho_type,$pho_url,$user_id){
        $insert_sql=array($this->field_mer_id=>$mer_id,$this->field_pho_name=>$pho_name,
            $this->field_pho_type=>$pho_type,$this->field_pho_url=>$pho_url,'con_project_id'=>$user_id);
        $result = $this->insert($this->TABLE, $insert_sql);
        return $result;
    }

    public function delete_photo($photo_url){
        $update_sql=array('pho_del'=>1);
        $where_sql=array($this->field_pho_url=>$photo_url);
        if ($this->update($this->TABLE,$update_sql,$where_sql)) {
            return true;
        }
        return false;
    }
}
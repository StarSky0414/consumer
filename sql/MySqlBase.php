<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/9
 * Time: 23:17
 */

require_once  dirname(__FILE__).'/../config/MySql_config.php';

/**
 * Class MySqlBase
 * SQL 基础类
 */
class MySqlBase
{
    /**
     * @var PDO 连接数据库的句柄
     */
    public $dbHandle;

    /**
     * MySqlBase constructor.
     * 用于连接数据库
     */
    public function __construct() {
        try {
            $dsn= sprintf("mysql:host=%s;dbname=%s;charset=utf8",MySql_config::$host,MySql_config::$dbname);
            $option = array(PDO::ATTR_DEFAULT_FETCH_MODE=> PDO::FETCH_ASSOC);
            $this->dbHandle=new PDO($dsn, MySql_config::$username, MySql_config::$password,$option);
        } catch (PDOException $exc) {
            echo '错误'.$exc->getTraceAsString();
        }
    }

    /**
     * @param $arr  /要格式化的数组，只支持一维数组
     * @return array  格式化后的数组
     * 用于SQL 操作时String类型双引号的添加
     */
    public function type_change($arr){
        $change_arr=array();
        foreach ($arr as $item) {
//            if (is_int(gettype()))
            if(is_string($item)){
                $change_arr[]="'$item'";
                continue;
            }
            $change_arr[]="$item";
        }
        //print_r($change_arr);
        return $change_arr;
    }

    /**
     * @param $table  /要插入的数据库表名
     * @param $insert_array  /要插入的数据 key（表字段）=>value（内容） 形式，
     *        支持批量插入 eg:
     *        $a[0]['session_id']="xxxxxx";
     *        $a[0]['user_id']=123;
     *        $a[0]['create_time']=789;
     *        $a[1]['session_id']="aaaaa";
     *        $a[1]['user_id']=123;
     *        $a[1]['create_time']=789;
     * @return int  成功返回插入行数，失败返回0
     */
    public function insert($table, $insert_array){
        $value=') value ';
        if(isset($insert_array[0])&&is_array($insert_array[0])){
            $batch_keys=array_keys($insert_array);
            $batch_value_array=array_values($insert_array);
            for($i=0;$i<sizeof($batch_keys);$i++){
                $array_values = $this->type_change(array_values($batch_value_array[$i]));
                $value.='('.implode(',',$array_values).')';
                $value.=',';
            }
            $value=substr($value,0,-1);
            $insert_array=$batch_value_array[0];
        }else{
            $array_values = $this->type_change(array_values($insert_array));
            $value.=' ('.implode(',',$array_values).')';
        }
        $sql="insert into $table (";
        $array_keys = array_keys($insert_array);
        $key=implode(',',$array_keys);
        $sql.=$key.$value;
//        echo $sql;  //测试语句···············
        return $this->dbHandle->exec($sql);//成功返回插入行数，失败返回0
    }


    /**
     * @param $table  /要查询的数据库表名
     * @param $select_array  /要查询的数据 array（key（表字段），key（表字段）。。。 ）形式
     * @param $where_array  /条件 key（表字段）=>value（内容） 形式，
     * @return array  返回查询结果的数组
     */
    public function select($table_name, $select_array, $where_array){
        $select="select ";
        $table=" from ";
        if (is_array($table_name)){
            $table.=implode(',',$table_name);
        }else{
            $table.=$table_name;
        }
        $where=" where 1=1 ";
        $array_values = array_values($select_array);
        $select.=implode(',',$array_values);
        if(isset($where_array)){
            $where_key=array_keys($where_array);
            $where_value=$this->type_change(array_values($where_array));
            $where_array = array_combine($where_key, $where_value);
            foreach ($where_array as $k=>$v) {
                $where.=' and '.$k.'='.$v;
            }
        }
        $sql=$select.$table.$where;
//        echo $sql;
        return $this->dbHandle->query($sql)->fetchAll();//返回查询结果的数组
    }

    /**
     * @param $table     /要更新的数据库表名
     * @param $update_array   /内容 key（表字段）=>value（内容） 形式，
     * @param $where_array    /条件 key（表字段）=>value（内容） 形式，
     * @return int    成功返回更新行数，失败返回0
     */
    public function update($table_name, $update_array, $where_array){
        $table=" update  ";
        if(is_array($table_name)){
            $table.=implode(',',$table_name);
        }else{
            $table.=$table_name;
        }
        $set = " set ";
        $where=" where 1=1 ";
        $update_array_key=array_keys($update_array);
        $update_array_value=$this->type_change(array_values($update_array));
        $update_array = array_combine($update_array_key, $update_array_value);
        foreach ($update_array as $k=>$v) {
            $set.= $k.'='.$v.",";
        }
        $set=substr($set,0,-1);
        if(isset($where_array)){
            $where_key=array_keys($where_array);
            $where_value=$this->type_change(array_values($where_array));
            $where_array = array_combine($where_key, $where_value);
            foreach ($where_array as $k=>$v) {
                $where.=' and '.$k.'='.$v;
            }
        }
        $sql=$table.$set.$where;
//        echo $sql;
        return $this->dbHandle->exec($sql);//返回修改行数，失败返回0
    }

    /**
     * @param $table  /要删除的数据库表名
     * @param $where_array    /条件 key（表字段）=>value（内容） 形式
     * @return int    成功返回删除行数，失败返回0
     */
    public function dele($table, $where_array){
        $table="delete from $table ";
        $where="where 1=2 ";
        if(isset($where_array)){
            $where_key=array_keys($where_array);
            $where_value=$this->type_change(array_values($where_array));
            $where_array = array_combine($where_key, $where_value);
            foreach ($where_array as $k=>$v) {
                $where.=' or '.$k.'='.$v;
            }
        }else{
            return 0;
        }
        $sql=$table.$where;
//        echo $sql;
        return $this->dbHandle->exec($sql);
    }
}
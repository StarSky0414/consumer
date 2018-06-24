<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/9
 * Time: 14:17
 */
require dirname(__FILE__) . '/../../config/SessionOverTime_config.php';
require dirname(__FILE__) . '/../../sql/SeesionMySql.php';
require dirname(__FILE__) . '/../../Tool/Time.php';

/**
 * Class MySession
 * 重写系统session
 */
class MySession
{
    private static $TABLE='con_session';
    private static $FIELD_SESSION_ID='session_id';
    private static $FIELD_USER_ID='user_id';
    private static $FIELD_CREATE_TIME='create_time';
    private static $FIELD_OUT_TIME='out_time';
    private static $seesionMySql;

    /**
     * MySession constructor.
     * 创建连接数据库
     */
    public function __construct()
    {

        self::$seesionMySql = new SeesionMySql();
    }


    /**
     * 根据user_id 创建session
     * @param $user_id  用户id
     * @return int|string  返回32位session
     */
    public function make_session($user_id){
        $session_id=md5(uniqid(md5(microtime(true)),true));
        $session=array(self::$FIELD_SESSION_ID=>$session_id,
            self::$FIELD_USER_ID=>(int)$user_id,self::$FIELD_CREATE_TIME=>(int)Time::now_time());
        if (self::$seesionMySql->insert(self::$TABLE,$session)){
            return $session_id;
        }
        return 0;
    }

    /**
     * 根据session_id 读取 user_id
     * @param $session_id
     * @return bool|void  超时不存在返回0  成功返回user_id
     */
    public function read_user_id($session_id){
        if($user_id=$this->verify_sesion($session_id)){
            return $user_id;
        }
        echo 250;
        return false;
    }

    private function verify_sesion($session_id){
        $select_sql=array(self::$FIELD_USER_ID,self::$FIELD_CREATE_TIME);
        if ($query=self::$seesionMySql->select(self::$TABLE,$select_sql,
            array(self::$FIELD_SESSION_ID=>$session_id,self::$FIELD_OUT_TIME=>0))){
            if ($this->overtime_session($query[0][self::$FIELD_CREATE_TIME],$session_id)) {
                return false;
            }
            //print_r($query);  //测试
            return $query[0][self::$FIELD_USER_ID];
        }
        return false;
    }

    private function overtime_session($time, $session_id){
        $nowtime=(int)Time::now_time();
        if (($nowtime-$time)>SessionOverTime_config::$OVER_TIME&&SessionOverTime_config::$OVER_TIME!=0){
            $update_sql=array(self::$FIELD_OUT_TIME=>1);
            $where_sql=array(self::$FIELD_SESSION_ID=>$session_id);
            self::$seesionMySql->update(self::$TABLE,$update_sql,$where_sql);
            return true;
        }
        return false;
    }

    public function clear_session($user){
            $update_sql=array(self::$FIELD_OUT_TIME=>1);
            $where_sql=array(self::$FIELD_USER_ID=>$user);
            self::$seesionMySql->update(self::$TABLE,$update_sql,$where_sql);
    }

}
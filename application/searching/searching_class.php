<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/18
 * Time: 10:56
 */

require_once dirname(__FILE__) . '/../../sql/searching_sql.php';
require_once dirname(__FILE__) . '/../mer_info/mer_info_class.php';

class searching_class
{
    private $searching_sql;

    public function __construct()
    {
        $this->searching_sql = new searching_sql();
    }

    private function condition($rank)
    {
        $rank_result = '';
        switch ($rank) {
            case '最新搜录':
                $rank_result = "order by mer_id DESC ";
        }

        return $rank_result;
    }

    private function circle($circle, $city)
    {
        $circle_result = "and city= '$city '";
        if ($circle == -'全部') {
            return $circle_result;
        } else {
            $circle_result .= " and circle = '$circle' ";
            return $circle_result;
        }
    }

    private function small_project($small_project)
    {
        $small_project_result = " and classify = '$small_project'";
        return $small_project_result;
    }

    private function num($num_start)
    {
        $num_long = 5;
        //limit 0,3;
        $num_result = "limit $num_start,$num_long";
        return $num_result;
    }

    private function joint_sql($small_project, $circle, $city, $rank, $num_start)
    {
        $joint_sql = "select mer_id,business_hours,name from merinfo WHERE 1=1 ";
        $small_project1 = $this->small_project($small_project);
        $circle1 = $this->circle($circle, $city);
        $condition = $this->condition($rank);
        $num = $this->num($num_start);
        $joint_result = $joint_sql . $small_project1 . $circle1 . $condition . $num;
        return $joint_result;
    }

    public function select_joint($small_project, $circle, $city, $rank, $num_start)
    {
        $joint_sql = $this->joint_sql($small_project, $circle, $city, $rank, $num_start);
        $joint_result = $this->searching_sql->joint_result($joint_sql);
        $mer_info_class = new mer_info_class();
        $mer_list['mer_list'] = '';
        foreach ($joint_result as $key => $value) {
            $mer_id = $value['mer_id'];
            $environment_show = $mer_info_class->environment_show($mer_id);
            $surface_show = $mer_info_class->surface_show($mer_id);
            $mer_list['mer_list'][$key]['mer_id'] = $value['mer_id'];
            $mer_list['mer_list'][$key]['mer_address'] = $value['address'];
            $mer_list['mer_list'][$key]['name'] = $value['name'];
            if (empty($environment_show['environment'])){
                $mer_list['mer_list'][$key]['environment'] = array();
            }else{
                $mer_list['mer_list'][$key]['environment'] = $environment_show['environment'];
            }
            $mer_list['mer_list'][$key]['surface'] = $surface_show['surface'][0];
        }
//        print_r($mer_list);
//        print_r(json_encode($mer_list,JSON_UNESCAPED_UNICODE));
        return $mer_list;
    }

    private function circle_list($city)
    {
        $table = 'merinfo';
        $select_sql = array('distinct  circle');
        $where_sql = array('city' => $city);
        $select = $this->searching_sql->select($table, $select_sql, $where_sql);
//        $list='';
//        foreach ($select as $key => $value){
//            $list[]=$value['circle'];
//        }
        return $select;
    }

    private function small_list(/*$city*/
        $circle_list)
    {
        /*$table='merinfo';
        $select_sql=array('distinct  classify');
        $where_sql=array('city'=>$city);
        $select = $this->searching_sql->select($table, $select_sql, $where_sql);
        foreach ($select as $key => $value){
            $list[]=$value['classify'];
        }
        return $list;*/
        $temp_list = array();
//        print_r($circle_list);
        foreach ($circle_list as $key => $item) {
            $circle = $item['circle'];
            $sql = 'select distinct  classify from merinfo where circle=?';
            $PDOStatement = $this->searching_sql->dbHandle->prepare($sql);
            $PDOStatement->execute(array($circle));
            $temp_list[$key]['name'] = $circle;
            $result = $PDOStatement->fetchAll();
            foreach ($result as $item) {
                $temp_list[$key]['list'][]=$item['classify'];
            }
        }
//        print_r($temp_list);
        return $temp_list;
    }

    private function order_by()
    {
        $order_by[] = '最新收录';
        $order_by[] = '消费最低(未写)';
        return $order_by;
    }

    public function show_list($city)
    {
        $circle_list = $this->circle_list($city);


        $small_list['circle_list']['select'] = $this->small_list($circle_list);
        $order_by = $this->order_by();
//        $list['liist']['circle']=$circle_list;
//        $list['liist']['classify']=$small_list;
        $small_list['circle_list']['order'] = $order_by;
//        print_r($list);
//        print_r($order_by);
//        print_r($small_list);
//        print_r($circle_list);
//        print_r(json_encode($list,JSON_UNESCAPED_UNICODE));
        return $small_list;
    }


}
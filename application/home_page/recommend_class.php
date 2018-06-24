<?php

require dirname(__FILE__).'/../../mysql/mysql_recommend.php';
//require dirname(__FILE__).'/../../mysql/mysql_geo.php';
require dirname(__FILE__).'/../tool/Geohash/geohash.class.php';
include dirname(__FILE__).'/../../config/config.php';

class Recommend{
    private $mysql_recommend;
    private $mysql_geo;
    private $geo;
    public function __construct() {
        $this->mysql_recommend=new MySql_recommend();
        //$this->mysql_geo= new MySql_geo();
        $this->geohash= new Geohash();
    }

    public function select_recom($long,$lat,$number){
        $big_pro=$this->mysql_recommend->find_big_project();
//        print_r($big_pro);
        $n_geohash=$this->geohash->encode($lat, $long);//long 精度
        $like_geohash= substr($n_geohash, 0,5);
        foreach ($big_pro as $key=>$val){
            $re_sele=$this->mysql_recommend->recommend_select($val['project'],$like_geohash);
//            print_r($val['project']);
            if(empty($re_sele)){
//                print_r("....");
                continue;
            }
//            print_r($re_sele);  
            //$geo_like= $this->geohash->nearby($long, $lat, 5);  //生成geohash码，并查找附近的商家
            shuffle($re_sele); //数组随机排序
            $rand_keys = array_rand($re_sele,$number); //随机取出数组
//            print_r($rand_keys);
            foreach ($rand_keys as $ran_key => $ran_val){
//                print_r($ran_val);
                $merinfo['merinfo'][$val['project']][]=($re_sele[$rand_keys[$ran_key]]);
            }
        }
//            print_r($merinfo);
            return $merinfo;
    }
}
        

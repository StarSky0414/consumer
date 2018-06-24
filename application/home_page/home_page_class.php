<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/15
 * Time: 15:20
 */
require_once dirname(__FILE__) . '/../../sql/home_page_sql.php';
class home_page_class{


    private static $advertising=array();
    private $housemanage_sql;

    public function __construct()
    {
        $this->housemanage_sql = new home_page_sql();
        self::$advertising[]['url']='https://thethreestooges.cn/merchant/img/photo_mer/advertising/ad_one.png';
        self::$advertising[]['url']='https://thethreestooges.cn/merchant/img/photo_mer/advertising/ad_two.png';
        self::$advertising[]['url']='https://thethreestooges.cn/merchant/img/photo_mer/advertising/ad_three.png';
        self::$advertising[]['url']='https://thethreestooges.cn/merchant/img/photo_mer/advertising/ad_four.png';
    }


    private function select_big_project(){
        $_table='big_project';
        $select_sql=array('big_id','project');
        $where_sql=array();
        return $this->housemanage_sql->select($_table,$select_sql,$where_sql);
    }

    public function show_classify($longitude,$latitude){
        ob_start();
        $key_array=array('recreation','food');
        $select_big_project = $this->select_big_project();
//        print_r($select_big_project);
        $home_page=array();
        foreach ($select_big_project as $k=>$v){
            $show_mer_info = $this->housemanage_sql->show_mer_info($v['big_id']);
            foreach ($show_mer_info as $ke =>$va){
                if($va['grade']==0){
                    $show_mer_info[$ke]['stars']=0;
                }else{
                    $show_mer_info[$ke]['stars']=(int)($va['grade']/$va['time']);
                }
                $show_mer_info[$ke]['distance']=$this->getDistance($va['latitude'],$va['longitude'],$latitude,$longitude)/1000.0;
            }
//            $home_page['name'.$k]['name']=$v['project'];
            $home_page[$key_array[$k]]=$show_mer_info;
        }
        $home_page['advertising']=self::$advertising;
//        $home_page1['home_page']=$home_page;
//        print_r($home_page1);
        ob_end_clean();
        $json_encode = json_encode($home_page, JSON_UNESCAPED_UNICODE);
        echo $json_encode;
    }

    private function getDistance($lat1, $lng1, $lat2, $lng2){
        $earthRadius = 6367000; //approximate radius of earth in meters
        $lat1 = ($lat1 * pi() ) / 180;
        $lng1 = ($lng1 * pi() ) / 180;
        $lat2 = ($lat2 * pi() ) / 180;
        $lng2 = ($lng2 * pi() ) / 180;
        $calcLongitude = $lng2 - $lng1;
        $calcLatitude = $lat2 - $lat1;
        $stepOne = pow(sin($calcLatitude / 2), 2) + cos($lat1) * cos($lat2) * pow(sin($calcLongitude / 2), 2);
        $stepTwo = 2 * asin(min(1, sqrt($stepOne)));
        $calculatedDistance = $earthRadius * $stepTwo;
        return round($calculatedDistance);
    }

}
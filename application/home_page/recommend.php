<?php
//ini_set("display_errors", "On");
//error_reporting(E_ALL | E_STRICT);
//require dirname(__FILE__).'/../../mysql/mysql_recommend.php';
////require dirname(__FILE__).'/../../mysql/mysql_geo.php';
//require dirname(__FILE__).'/../tool/Geohash/geo_class.php';
//include dirname(__FILE__).'/../../config/config.php';
//srand((float) microtime() * 10000000);
//
//$mysql_recommend=new MySql_recommend();
//$mysql_geo= new MySql_geo();
//$geo= new Geo();
//$long=121.53454;
//$lat=38.862532;
//$number=2;
//
//$kv=$mysql_recommend->find_big_project();
//$geo_like=$geo->nearby($long, $lat, 5);
////foreach ($geo_like as $key => $val){
////    $shop_id[$val['shop_id']]=0;
////}
//shuffle($geo_like);
////print_r($shop_id);
//$rand_keys = array_rand($geo_like,$number);
//for($i=0;$i<$number;$i++){
//    $merinfo['merinfo'][]=($geo_like[$rand_keys[$i]]);
//}
//
//
//print_r($merinfo);
//print_r($geo_like);
//$geo_id=$mysql_geo->select_geo_id($geo_like);
////print_r($geo_id);
//foreach ($kv as $key=>$val){    
//    $temp[$val['project']]=$mysql_recommend->recommend_select($val['project']);
//}
//print_r(json_encode($temp,JSON_UNESCAPED_UNICODE));

require  dirname(__FILE__).'/recommend_class.php';
$lat=121.53454;
$long=38.862532;
$number=2;
$recom_cl=new Recommend();
$reco_json=$recom_cl->select_recom($long, $lat, $number);
print_r(json_encode($reco_json,JSON_UNESCAPED_UNICODE));
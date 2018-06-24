<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require dirname(__FILE__).'/../tool/Geohash/geo_class.php';

$shop_id=9;
$long=121.530636;
$lat=38.861386;
$geo=new Geo();
$geo_show=$geo->nearby($long, $lat);

$t=$geo->geohash_make($long, $lat, $shop_id);
return;


foreach ($geo_show as $key=>$val){
    $geo_show[$key]['dis']=$geo->getDistance($lat, $long, $val['lat'], $val['lon']);
    unset($geo_show[$key]['lat']);
    unset($geo_show[$key]['lon']);
    $distance[]=$geo_show[$key]['dis'];
}
array_multisort($distance,SORT_NUMERIC,$geo_show);
print_r(json_encode($geo_show,JSON_UNESCAPED_UNICODE));

<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);

require_once __DIR__ . '/autoload.php';

$accessKeyId = "STS.J7owprnkf9oVPZwYPtag7PPDz";
$accessKeySecret = "uYBcsT38NapgcD2zbwJmL8h2tqqixUnKMHZQ16B4rG9";
$securityToken = "CAIS/QF1q6Ft5B2yfSjIq/TaPMrGg7RHjq29UnzGvVAhbegbv5XvmDz2IHtKe3ZvAekZsfkwlWxT7fwclqp5QZUd04t0zS00vPpt6gqET9frma7ctM4p6vCMHWyUFGSIvqv7aPn4S9XwY+qkb0u++AZ43br9c0fJPTXnS+rr76RqddMKRAK1QCNbDdNNXGtYpdQdKGHaOITGUHeooBKJVxAx4Fsk0DMisP3vk5DD0HeE0g2mkN1yjp/qP52pY/NrOJpCSNqv1IR0DPGajnEPtEATq/gr0/0Yomyd4MvuCl1Q8giANPHP7tpsIQl2a643AadYq+Lmkvl1qmkSey1SFdInGoABEKWzX3fegsiMXhuYI9ceBnqnw6MDufyR1AI8/7RQHw3KyTTUquJ9cl2/sbyhpPZ1d+rVxH6OYegUW/oBmgprzIGc6U+xK5qq5olM3aDWG9p8p1i9dNmFo2l/2+CEJkGNpuUgokOsmZvo5L2BhJeL/OrN5M2fA1yoKOsA/y78Wc4=";
$endpoint = "oss-cn-shenzhen.aliyuncs.com";
$ossClient = new \OSS\OssClient($accessKeyId, $accessKeySecret, $endpoint, false, $securityToken);
print_r($ossClient);
$bucket='thethreestooges';
$object = "property/123.txt";
$object1 = $ossClient->getObject($bucket, $object);
print_r($object1);
print(__FUNCTION__ . ": OK" . "\n");


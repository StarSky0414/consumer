<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/20
 * Time: 21:03
 */

$circle_id = $_POST['circle_id'];
$circle_class = new circle_class();
$comment_particular = $circle_class->comment_particular($circle_id);
//$comment_particular['comment'];
//    print_r($comment_particular);
    echo json_encode($comment_particular,JSON_UNESCAPED_UNICODE);
    return ;
/*}
echo '{"comment":[]}';*/


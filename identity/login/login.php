<?php
//The file URL https://thethreestooges.cn:5210/identity/login/login.php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require dirname(__FILE__).'/../../sql/login_sql.php';
require dirname(__FILE__).'/../session/MySession.php';

$user=$_POST['username'];
$password=$_POST['password'];
ob_start();
$login_sql = new login_sql();
$TABLE='con_user';
if(!empty($user)&&!empty($password)){
    $q=$login_sql->select($TABLE,array('password','id'),array('user'=>$user))[0];
    print_r($q);
//    $q=$q;
    if ($q['password']== ($password)){
        $mySession = new MySession();
        $mySession->clear_session($q['id']);

        $make_session = $mySession->make_session($q['id']);
        ob_end_clean();
        echo $make_session;
        return ;
    }
    ob_end_clean();
    echo '0';
    return;
    
}
ob_end_clean();
echo '4';
return ;
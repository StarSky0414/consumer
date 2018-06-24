<?php
//ini_set("display_errors", "On");
//error_reporting(E_ALL | E_STRICT);
require dirname(__FILE__).'/../../mysql/mysql_login.php';
require dirname(__FILE__).'/../tool/session/session.php';


$user=$_POST['username'];
$password=$_POST['password'];

$mysql_con=new MySql_login();

if(!empty($user)&&!empty($password)){
    if($mysql_con->login($user)['password']== ($password)){
        //echo session::make_session($user);
        echo '0';
        return ;
    }
    echo '1';
    return;
    
}
echo '4';
return ;
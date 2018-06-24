<?php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require_once dirname(__FILE__).'/login_class.php';

$ver=$_POST['mail_ver'];
$mail=$_POST['mail_address'];


$login_class = new  login_class();
$ver_name_pw = $login_class->ver_name_pw($mail);
if (!empty($ver_name_pw)&&($ver_name_pw==$ver)){
    if ($login_class->ver_pass($mail)) {
        echo 1;
        return;
    }
}
echo 0;
return;

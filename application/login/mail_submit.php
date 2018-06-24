<?php
//URLAddress:  https://thethreestooges.cn:666/application/login/mail_submit.php
ini_set("display_errors", "On");
error_reporting(E_ALL | E_STRICT);
require dirname(__FILE__).'/login_class.php';


if (!isset($_POST['mail_address'])){
    echo 0;
    return ;
}
$mail=$_POST['mail_address'];
$login_class = new login_class();
$temp_mail_address = $login_class->temp_mail_address($mail);
if ($temp_mail_address) {
    echo 1;
    return;
}
echo  0;
return;


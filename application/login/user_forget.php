<?php
//ini_set("display_errors", "On");
//error_reporting(E_ALL | E_STRICT);
require_once dirname(__FILE__).'/login_class.php';
$mail = $_POST['username'];
$password = $_POST['password'];

$login_class = new login_class();
if ($login_class->user_forget_writ($mail, $password)) {
    echo 1;
    return;
}
echo 0;
return;
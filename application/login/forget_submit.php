<?php
/**
 * 忘记密码
 */

require_once dirname(__FILE__).'/login_class.php';
$mail=$_POST['mail_address'];
$login_class = new login_class();
$forget_mail_address = $login_class->forget_mail_address($mail);
if ($forget_mail_address) {
    echo 1;
    return;
}
echo  0;
return;
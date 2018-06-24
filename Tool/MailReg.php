<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/10
 * Time: 22:37
 */

class MailReg
{
    public static function mail_reg()
    {
        $size = 5; //验证码位数
        $num_0 = 48;
        $num_9 = 57;
        $letter_A = 65;
        $letter_Z = 90;
        $st_random = "";
        for ($i = 0; $i < $size; $i++) {
            $st_random = $st_random . (string)chr(rand(0, 1) ? rand($num_0, $num_9) : rand($letter_A, $letter_Z));
        }

//        echo $st_random;
        return $st_random;
    }

    public static function mail_push($mail_address,$st_random)
    {
        $mail_test="This is the verification code  $st_random  .";
        $mail_title="TTS";
        system ("echo \"$mail_test\" | mail -s \"$mail_title\" $mail_address",$ret);
    }
}
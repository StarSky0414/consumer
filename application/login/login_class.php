<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/12
 * Time: 14:36
 */
require_once dirname(__FILE__) . '/../../Tool/MailReg.php';   //ok!
require_once dirname(__FILE__) . '/../../Tool/Time.php';
require_once dirname(__FILE__) . '/../../config/LoginOverTime_config.php';
require_once dirname(__FILE__) . '/../../sql/login_sql.php';


class login_class
{
    private $redis;

    private $login_sql;

    public function __construct()
    {
        $this->redis = new Redis();
        $this->redis->connect('127.0.0.1', '6379');
        $this->login_sql = new login_sql();
    }


    public function temp_mail_address($mail_address)
    {
        $key="sweet:login:cache:$mail_address:string";
        $mailReg = new MailReg();
        $mail_reg = $mailReg->mail_reg($mail_address);
        $setnx = $this->redis->setnx($key, $mail_reg);
        if (!$setnx) {
            return false;
        }
        $mailReg->mail_push($mail_address, $mail_reg);
        $this->redis->setTimeout($key, LoginOverTime_config::$OVER_TIME);
        return true;
    }

    public function forget_mail_address($mail_address)
    {
        $key="sweet:login:cache:$mail_address:string";
        $mailReg = new MailReg();
        $mail_reg = $mailReg->mail_reg($mail_address);
        $str = $this->redis->get($key);
        if (!$str || ($str == 1)) {
            $this->redis->set($key, $mail_reg);
            $mailReg->mail_push($mail_address, $mail_reg);
            $this->redis->setTimeout($key, LoginOverTime_config::$OVER_TIME);
            return true;
        }
        return false;
    }

    public function ver_name_pw($mail_address)
    {
        $key="sweet:login:cache:$mail_address:string";
        $setnx = $this->redis->get($key);
        return $setnx;
    }

    public function ver_pass($mail_address)
    {
        $key="sweet:login:cache:$mail_address:string";
        $this->redis->setTimeout($key, '0');
        $set = $this->redis->set($key, 1);
        return $set ? 1 : 0;
    }

    public function user_writ($mail, $password)
    {
        $key="sweet:login:cache:$mail:string";
        $str = $this->redis->get($key);
        if ($str == 1) {
            $write_user_insert = $this->login_sql->write_user_insert($mail, $password);
            return $write_user_insert ? true : false;
        } else {
            return false;
        }
    }

    public function user_forget_writ($mail,$password){
        $key="sweet:login:cache:$mail:string";
        $str = $this->redis->get($key);
        if ($str == 1) {
            $write_user_insert = $this->login_sql->write_user_update($mail, $password);
            return $write_user_insert ? true : false;
        } else {
            return false;
        }
    }
}
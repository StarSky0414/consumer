<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/3/16
 * Time: 11:19
 */
require_once dirname(__FILE__) . '/../../sql/vip_sql.php';

class myself_class
{
    private $myself_sql;

    public function __construct()
    {
        $this->myself_sql = new myself_sql();
    }

    /**
     * @param $user_id
     * @return mixed
     */
    public function myself_info($user_id)
    {
        $vip_sql = new vip_sql();
        $myself_info = $this->myself_sql->user_info($user_id);
        $myself_info['attention_to_me_num'] = $this->myself_sql->attention_to_me($user_id);
        $myself_info['me_to_attention_num'] = $this->myself_sql->me_to_attention($user_id);
        $myself_info['collect'] = '0';
        $myself_info['comment_num'] = $this->myself_sql->comment_num($user_id);
        /////////////////vip   start////////////////////
        $user_vip_list_select = $vip_sql->user_vip_list_select($user_id);
        $myself_info['vip_card_num'] = 0;
        if (!empty($user_vip_list_select)) {
            foreach ($user_vip_list_select as $item) {
                $mer_id = $item['mer_id'];
                $user_vip_list_vip_manage_select = $vip_sql->user_vip_list_vip_manage_select($user_id, $mer_id)['VIP_name'];
                if (!empty($user_vip_list_vip_manage_select)) {
                    $myself_info['vip_card_num']++;
                }
            }
        }
        $myself_info['vip_card_num'] = (string)$myself_info['vip_card_num'];
        //////////////////vip   end/////////////////////

        $myself_info['indent_num'] = $this->myself_sql->indent_num($user_id);
        return $myself_info;
    }

    public function photo_change($userId, $photo_path)
    {
        $photo_change_sql = $this->myself_sql->photo_change_sql($userId, $photo_path);
        return $photo_change_sql;
    }

    public function nickname_change($userId, $nickname)
    {
        $photo_change_sql = $this->myself_sql->nickname_change_sql($userId, $nickname);
        return $photo_change_sql;
    }

    public function indent_history_lsit($userId, $start)
    {
        $indent_history_lsit = $this->myself_sql->indent_history_lsit($userId, $start);
        return $indent_history_lsit;
    }

    public function circle_reply_lsit($userId, $start)
    {

        //reply_circle_id,circle_id,content,reply_user
        $circle_reply_lsit_select = $this->myself_sql->circle_reply_lsit_select($userId, $start);
        foreach ($circle_reply_lsit_select as $key => $value) {
            $reply_user = $value['reply_user'];
            $reply_circle_id = $value['reply_circle_id'];
            $nickname = $this->myself_sql->get_nickname($reply_user);
            $circle_reply_lsit_select[$key]['reply_user_nickname']=$nickname;
            $publish_photo = $this->myself_sql->get_publish_photo($reply_circle_id);
            $circle_reply_lsit_select[$key]['publish_photo']=$publish_photo;
        }
        return $circle_reply_lsit_select;
    }

    public function change_pwd($userId, $pwd)
    {
        $change_pwd_update = $this->myself_sql->change_pwd_update($userId, $pwd);
        return $change_pwd_update;
    }
}
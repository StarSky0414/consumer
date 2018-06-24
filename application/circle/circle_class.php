<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 0:42
 */
require_once dirname(__FILE__) . '/../../Tool/Photo_upload.php';

class circle_class
{

    private $circle_sql;

    public function __construct()
    {
        $this->circle_sql = new circle_sql();
    }

    private function next_circle_id($user)
    {
        $count_user = $this->circle_sql->count_user($user);
        return $count_user['count(*)'] ? (int)$count_user['count(*)'] + 1 : 1;
    }

    public function issue($user, $mer_id, $content, $json_encode)
    {
        $next_circle_id = $this->next_circle_id($user);
        $circle_id = $user . '_' . $next_circle_id;
        $photo_up = $this->photo_up($mer_id, $json_encode, $circle_id);
        if (!$photo_up) {
            return false;
        }

        if ($this->circle_sql->issue_sql($circle_id, $user, $mer_id, $content)) {
            return true;
        }
        return false;
    }

    public function comment($user_id, $mer_id, $content, $reply_user, $reply_circle_id)
    {
        $next_circle_id = $this->next_circle_id($user_id);
        if ($this->circle_sql->comment_sql($user_id . '_' . $next_circle_id, $user_id, $mer_id, $content, $reply_user, $reply_circle_id)) {
            return true;
        }
        return false;
    }

    public function attention($attention_user, $attention_by_user)
    {
        $attention_sql = $this->circle_sql->create_attention_sql($attention_user, $attention_by_user);
        return $attention_sql;
    }

    public function photo_up($mer_id, $photo_url, $circle_id)
    {
        $json_decode = json_decode($photo_url);
        foreach ($json_decode as $item) {
            $insert_photo = Photo_upload::insert_photo('issue', $mer_id, $item, $circle_id);
            if (!$insert_photo) {
                return false;
            }
        }
        return true;
    }

    private function exist_friend($user_id)
    {
        $select_friend = $this->circle_sql->select_friend($user_id);
        return $select_friend;
    }

    private function type_select($type, $start, $user_id)
    {
        $select_issue_frind = null;
        switch ($type) {
            case '朋友':
                $exist_friend = $this->exist_friend($user_id);
                $exist_friend[]=$user_id;
//                print_r($exist_friend);
                $select_issue_frind = $this->circle_sql->select_issue_frind($exist_friend, $start);
                break;
            case '今日':
                $select_issue_frind = $this->today($start);
                break;
            case '广场':
                break;
            case 'mer_circle':
                $mer_id=$user_id;//借用变量
                $select_issue_frind=$this->mer_circle($mer_id,$start);
                break;
        }
        return $select_issue_frind;

    }

    public function circle_show($type, $start, $user_id)
    {
//        $start=0;
//        $select_issue_frind = $this->circle_sql->select_issue_frind(array(4, 5), $start);
        $select_issue_frind = $this->type_select($type, $start, $user_id);
//        print_r($select_issue_frind);
        if (!$select_issue_frind) {
//            return '{"circle_list": []}';
            $circle_list['circle_list']=array();
            return $circle_list;
        }

        foreach ($select_issue_frind as $key => $value) {
            $nikcname = $this->circle_sql->nikcname($value['user_id']);
            $select_issue_frind[$key]['nikcname'] = $nikcname;
            $select_issue_frind[$key]['exp'] = $this->circle_sql->exp($value['user_id']);
            $select_issue_frind[$key]['relation_sign'] = $this->circle_sql->count_sign_state($user_id, $value['user_id']);
            $select_issue_frind[$key]['mer_name'] = $this->circle_sql->find_mer_name($value['mer_id']);
            $select_issue_frind[$key]['photo_url'] = $this->circle_sql->photo_loding_sql($value['circle_id']);

            $select_comment_frind = $this->circle_sql->select_comment_frind($value['circle_id']);
            foreach ($select_comment_frind as $k => $v) {
                $nikcname = $this->circle_sql->nikcname($v['user_id']);
                $select_comment_frind[$k]['nikcname'] = $nikcname;
            }
//            $select_issue_frind[$key]['comment'] = $select_comment_frind;
            $select_issue_frind[$key]['comment_num'] = count($select_comment_frind);
//            print_r($select_comment_frind);
        }
//        print_r($select_issue_frind);
//        print_r(json_encode($select_issue_frind,JSON_UNESCAPED_UNICODE));
        $list['circle_list'] = $select_issue_frind;
//        print_r($list);
        return $list;
    }

    public function comment_particular($circle_id)
    {
        $select_comment_frind = $this->circle_sql->select_comment_frind($circle_id);
        foreach ($select_comment_frind as $k => $v) {
            $nikcname_user = $this->circle_sql->nikcname($v['user_id']);
            $nikcname_reply_user = $this->circle_sql->nikcname($v['reply_user']);
            $select_comment_frind[$k]['nikcname_user'] = $nikcname_user;
            $select_comment_frind[$k]['nikcname_reply_user'] = $nikcname_reply_user;
        }
        $select_issue_frind['comment'] = $select_comment_frind;
        return $select_issue_frind;
    }

    public function like_num_add($circle_id)
    {
        $like_num_add_sql = $this->circle_sql->like_num_add_sql($circle_id);
        return $like_num_add_sql;
    }

    private function today($start)
    {
        $today_select = $this->circle_sql->today_select($start);
        return $today_select;
    }

    private function mer_circle($mer_id,$start)
    {
        $mer_circle_select = $this->circle_sql->mer_circle_select($mer_id, $start);
        return $mer_circle_select;
    }

    public function circle_dele($circle_id)
    {
        $circle_dele = $this->circle_sql->circle_dele($circle_id);
        return $circle_dele;
    }
}
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/2/12
 * Time: 0:42
 */

class circle_sql extends MySqlBase
{
    public function count_user($user_id)
    {
        $sql = 'SELECT count(*) FROM circle WHERE user_id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        $num = $PDOStatement->fetch();
        return $num;
    }

    public function issue_sql($circle_id, $user_id, $mer_id, $content)
    {
        $sql = 'INSERT INTO circle (circle_id, user_id, mer_id, content) VALUE (?,?,?,?);';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $result = $PDOStatement->execute(array($circle_id, $user_id, $mer_id, $content));
        return $result;
    }

    public function comment_sql($circle_id, $user_id, $mer_id, $content, $reply_user, $reply_circle_id)
    {
        $sql = 'INSERT INTO circle (circle_id, user_id, mer_id, content, reply_user,reply_circle_id) VALUE (?,?,?,?,?,?);';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $result = $PDOStatement->execute(array($circle_id, $user_id, $mer_id, $content, $reply_user, $reply_circle_id));
        return $result;
    }

    private function sele_attention_by_sql($attention_user, $attention_by_user)
    {
        $sql = 'SELECT count(*) FROM attention WHERE attention_by_user=? AND attention_user=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($attention_user, $attention_by_user));
        $var = $PDOStatement->fetch();
        return $var['count(*)'];
    }

    public function dele_attention_sql($attention_user, $attention_by_user)
    {
        $sql = 'UPDATE   attention SET dele_sign=1 WHERE attention_user=? AND attention_by_user =?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($attention_user, $attention_by_user));
    }

    public function create_attention_sql($attention_user, $attention_by_user)
    {
        $this->dele_attention_sql($attention_user, $attention_by_user);
        $sql = 'INSERT INTO attention (attention_user, attention_by_user) VALUE (?,?);';
        $PDOStatement = $this->dbHandle->prepare($sql);
        if ($PDOStatement->execute(array($attention_user, $attention_by_user))) {
            if ($a = $this->sele_attention_by_sql($attention_user, $attention_by_user)) {
                return 2;
            } else {
                return 1;
            }
        }
        return 0;
    }

    /*    public function select_attention_sql($attention_user, $attention_by_user)
        {

        }*/

    public function nikcname($user_id)
    {
        $sql = 'SELECT nickname  FROM con_user WHERE id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        return $PDOStatement->fetch()['nickname'];
    }


    public function select_issue_frind($frind_user_id, $start)
    {
        $sql = 'SELECT circle_id,user_id,mer_id,content,create_time,like_num FROM circle WHERE dele_sign=0 AND reply_user =0 AND ( 1=0';
        $sql_where = ') ORDER BY create_time DESC LIMIT ' . ($start * 5) . ',5;';
        foreach ($frind_user_id as $item) {
            $sql .= ' or user_id=' . $item;
        }
        $sql .= $sql_where;
//        print_r($sql);
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute();
        $all = $PDOStatement->fetchAll();
        return $all;
    }


    public function select_comment_frind($circle_id)
    {
        $sql = 'SELECT circle_id,user_id,mer_id,content,create_time,reply_user  FROM circle WHERE dele_sign=0 AND reply_circle_id =?  ORDER BY create_time ;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($circle_id));
        $all = $PDOStatement->fetchAll();

        return $all;
    }

    public function photo_loding_sql($con_project_id)
    {
        $sql = 'SELECT pho_url FROM photo_manage WHERE pho_type=\'issue\' AND pho_del=0 AND con_project_id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($con_project_id));
        $all = $PDOStatement->fetchAll(PDO::FETCH_COLUMN, 0);
        return $all;
    }

    public function exp($user_id)
    {
        $sql = 'SELECT exp  FROM con_user WHERE id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        return $PDOStatement->fetch()['exp'];
    }

    public function select_friend($user_id)
    {
        $sql = 'SELECT attention_by_user FROM attention WHERE dele_sign=0 AND attention_user=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($user_id));
        return $PDOStatement->fetchAll(PDO::FETCH_COLUMN, 0);
    }

    public function count_sign_state($attention_user, $attention_by_user)
    {
        $sql = 'SELECT count(*) FROM attention WHERE dele_sign=0 AND ( attention_user=? AND attention_by_user =? )OR (attention_by_user=? AND attention_user=?);';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($attention_user, $attention_by_user, $attention_user, $attention_by_user));
        $count = $PDOStatement->fetch()['count(*)'];
        return $count;
    }

    public function find_mer_name($mer_id)
    {
        $sql = 'SELECT name FROM merinfo WHERE mer_id=?;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $name = $PDOStatement->fetch()['name'];
        return $name;
    }

    public function like_num_add_sql($circle_id)
    {
        $sql = 'UPDATE circle SET like_num=like_num+1 WHERE circle_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $execute = $PDOStatement->execute(array($circle_id));
        return $execute;
    }

    public function today_select($start)
    {
        $sql = 'SELECT
  circle_id,
  user_id,
  mer_id,
  content,
  create_time,
  like_num
FROM circle
WHERE dele_sign = 0 AND reply_user = 0 AND date_format(create_time, \'%Y-%m-%d\') = date_format(now(), \'%Y-%m-%d\')
ORDER BY create_time DESC LIMIT ' . ($start * 5) . ',5;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute();
        $all = $PDOStatement->fetchAll();
        return $all;
    }

    public function mer_circle_select($mer_id, $start)
    {
        $sql = 'SELECT
  circle_id,
  user_id,
  mer_id,
  content,
  create_time,
  like_num
FROM circle
WHERE dele_sign = 0 AND reply_user = 0 AND mer_id=?
ORDER BY like_num DESC LIMIT ' . ($start * 5) . ',5;';
        $PDOStatement = $this->dbHandle->prepare($sql);
        $PDOStatement->execute(array($mer_id));
        $all = $PDOStatement->fetchAll();
        return $all;
    }

    public function circle_dele($circle_id)
    {
        $sql = 'UPDATE circle SET dele_sign=1 WHERE circle_id=? OR  reply_circle_id=?';
        $PDOStatement = $this->dbHandle->prepare($sql);
        return $PDOStatement->execute(array($circle_id,$circle_id));

    }

}
<?php
/**
 * 有多少人得不到的，是你所拥有的！且行且珍惜！！
 * User: StarSky
 * Date: 2018/1/16
 * Time: 11:18
 */

require_once dirname(__FILE__) . '/../sql/Photo_tool_sql.php';


class Photo_upload
{

    private static function max_photo_name_all($typename, $mer_id)
    {
        $photo_tool_sql = new Photo_tool_sql();
        $max_photo_name_all = $photo_tool_sql->max_photo_name($typename, $mer_id);
//        print_r($max_photo_name);
        return $max_photo_name_all;
    }

    /**
     *
     *  弃用函数
     *
     */
    /*public static function photo_up($typename, $mer_id)
    {

        if (!isset($_FILES['up_photo']['name'])) {
            echo '2';
            return false;
        }
        $string = $_FILES['up_photo']['name'];
        $postfix = explode('.', $string)[1];
        $max_photo_name = self::max_photo_name_all($typename, $mer_id);
        $max_photo_name++;
        $mkdir_file_path = __PHOTO_PATH__ . '/' . $mer_id . '/' . $typename;
        $photo_file_path = __PHOTO_PATH__ . '/' . $mer_id . '/' . $typename . '/' . $max_photo_name . $postfix;
        $photo_url = __PHOTO_URL__ . '/' . $mer_id . '/' . $typename . '/' . $max_photo_name . '.' . $postfix;
        if (!is_dir($mkdir_file_path)) {
            mkdir($mkdir_file_path, 0777, true);
        }
        if (is_uploaded_file($_FILES['up_photo']['tmp_name'])) {
            if (move_uploaded_file($_FILES['up_photo']['tmp_name'], $photo_file_path)) {
                $photo_tool_sql = new Photo_tool_sql();
                $photo_tool_sql->insert_photo($mer_id, $max_photo_name, $typename, $photo_url);
                return $photo_url;
            }
        }
    }*/

    public static function insert_photo($typename, $mer_id, $photo_url, $user_id)
    {
        $max_photo_name = self::max_photo_name_all($typename, $mer_id);
        $max_photo_name++;
        $photo_tool_sql = new Photo_tool_sql();
        $insert_photo = $photo_tool_sql->insert_photo($mer_id, $max_photo_name, $typename, $photo_url, $user_id);
        return $insert_photo;
    }

    public static function delete_photo($photo_url)
    {
        $photo_tool_sql = new Photo_tool_sql();
        if ($photo_tool_sql->delete_photo($photo_url)) {
            return true;
        } else {
            return false;
        }
    }

    public static function update_photo($photo_url, $typename, $mer_id,$user_id)
    {
        self::delete_photo($photo_url);
        if (self::insert_photo($photo_url, $typename, $mer_id,$user_id)) {
            return true;
        } else {
            return false;
        }
    }
}
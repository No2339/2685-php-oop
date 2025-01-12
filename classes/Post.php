<?php
class Post extends Model
{
    const TABLE = 'pst_posts';


    static function searchByUserId($user_id)
    {
        $table = static::TABLE;
        $qry = "SELECT * FROM $table WHERE `user_id` = $user_id AND `deleted_at` IS NULL ORDER BY created_at DESC";
        $res = Model::$db->query($qry);
        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
}
<?php
class User
{
    static function all($limit = null)
    {
        $db = new mysqli('localhost', 'root', '', '2685_php_posts');

        $qry = 'SELECT * FROM `pst_users` WHERE `deleted_at` IS NULL';

        if ($limit) {
            $qry .= " LIMIT $limit";
        }

        $res = $db->query($qry);

        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
}
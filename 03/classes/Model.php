<?php

abstract class Model
{
    static $db;

    // constants
    const SOFT_DELETE = true;


    static function connct()
    {
        self::$db = new mysqli('localhost', 'root', '', '2685_php_posts');

    }


    static function all($limit = null)
    {
        $table = 'pst_' . static::TABLE;

        $qry = "SELECT * FROM `$table`  ";


        if (static::SOFT_DELETE) {
            $qry .= ' WHERE `deleted_at` IS NULL';
        }


        if ($limit) {
            $qry .= " LIMIT $limit";
        }

        $res = self::$db->query($qry);

        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }


    static function show($id)
    {
        $table = 'pst_' . static::TABLE;

        $qry = "SELECT * FROM `$table` WHERE `deleted_at` IS NULL AND `id` = '$id';";

        $res = self::$db->query($qry);

        return mysqli_fetch_assoc($res);
    }


    static function get_count()
    {

        $table = 'pst_' . static::TABLE;

        $qry = "SELECT COUNT(*) AS `count` FROM `$table`";


        if (static::SOFT_DELETE) {
            $qry .= ' WHERE `deleted_at` IS NULL';
        }

        $res = self::$db->query($qry);

        return mysqli_fetch_column($res);

    }

    abstract static function store(array $data);

    abstract static function search(string $keyword);

}
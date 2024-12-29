<?php


class User extends Model
{
    //    Constants
    const TABLE = 'users';


    static function admins()
    {

        $table = 'pst_' . static::TABLE;

        // $qry = 'SELECT * FROM `pst_' . static::TABLE . '` WHERE `roles` = "admin";';
        $qry = "SELECT * FROM `$table` WHERE `roles` = 'admin';";

        $res = self::$db->query($qry);

        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }
}
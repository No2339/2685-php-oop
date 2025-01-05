<?php

class Model
{
    static $db;

    
static function connct()
    {
        Model::$db = new mysqli('localhost', 'root', '', '2685_php_posts');

    }
    //  Recent Posts 5 Limits
    static function all($limit = null)
    {
        $table = static::TABLE;

         $qry="SELECT * FROM $table WHERE `deleted_at` IS NULL ORDER BY created_at DESC" ;

 

         if ($limit) {
         $qry .= "  Limit $limit";
         }

         $res= Model::$db->query($qry);

         return mysqli_fetch_all( $res , MYSQLI_ASSOC);
        
    }
    // All Post
    static function get_count()
    {
     
        $table= static::TABLE;

        $qry = "SELECT COUNT(*) AS `count` FROM `$table` WHERE `deleted_at` IS NULL";

        $res = Model::$db->query($qry);

        return mysqli_fetch_column($res);

    }
    
// All Reactions
    static function get_total_reactions()

    
    {

        $table = static::TABLE;

        $qry = "SELECT COUNT(*) AS total_reactions FROM $table WHERE deleted_at IS NULL";

        $res = Model::$db->query($qry);

        return mysqli_fetch_column($res);
    }
 
  //  Show Post 
static function show($id)
{
    $db = new mysqli('localhost', 'root', '', '2685_php_posts');

    $qry = "SELECT pst_users.name, pst_posts.body,  pst_posts.title , pst_posts.user_id , pst_posts.created_at
FROM pst_posts
LEFT JOIN pst_users ON pst_users.id = pst_posts.user_id where user_id = $id LIMIT 1";

    $res = Model::$db->query($qry);

    return mysqli_fetch_all($res, MYSQLI_ASSOC);
}
}





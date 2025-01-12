<?php
class User extends Model
 

{
    const TABLE = 'pst_users';


// All admins / All user / All guest / All moderator

static function get_cast()
{
$qry = "SELECT  pst_users.name , pst_users.email ,pst_users.roles  FROM pst_users where roles= 'admin';";
$count = "SELECT COUNT(*) AS total_admins FROM pst_users WHERE roles = 'admin';";
$users = "SELECT COUNT(*) AS total_users FROM pst_users where roles= 'user';";
$guest = "SELECT COUNT(*) AS total_users FROM pst_users where roles= 'guest';";
$moderator=" SELECT COUNT(*) AS total_users FROM pst_users where roles= 'moderator'" ;

$res = Model::$db->query($qry);
$res_count =  Model::$db->query($count);
$res_users = Model::$db->query($users);
$res_guest= Model::$db->query($guest);
$res_moderator = Model::$db->query($moderator);

$rows = mysqli_fetch_all($res, MYSQLI_ASSOC);
$count= mysqli_fetch_column($res_count);
$users= mysqli_fetch_column($res_users);
$guest= mysqli_fetch_column($res_guest);
$moderator = mysqli_fetch_column($res_moderator);

    return [
        'rows' => $rows,
        'total' => $count,
        'users' => $users,
        'guest'=> $guest,
        'moderator' => $moderator,
      
    ];
}
// get user dashboard
public static function getUserPostsAndComments($user_id)
{
    $qry = "
        SELECT 
            pst_users.id AS user_id, 
            pst_users.name AS user_name,
            pst_posts.id AS post_id,
            pst_posts.title AS post_title,
            pst_posts.body AS post_body,
            pst_comments.id AS comment_id,
            pst_comments.comment AS comment_text
        FROM 
            pst_users 
        LEFT JOIN pst_posts ON pst_users.id = pst_posts.user_id
        LEFT JOIN pst_comments ON pst_posts.id = pst_comments.post_id
        WHERE pst_users.id = $user_id
    ";

    return Model::$db->query($qry)->fetch_all(MYSQLI_ASSOC);
}

// roles dashboard admin info
static function admins(){

    $roleusers="SELECT * FROM pst_users where roles= 'admin';";
    $res_roleusers =  Model::$db->query($roleusers);
    return  mysqli_fetch_all($res_roleusers , MYSQLI_ASSOC);
}

// roles dashboard users info
public static function getUserInfo($user_id)
{
    $table = static::TABLE;
    $qry = "SELECT name, email, roles FROM $table WHERE id = $user_id";
    $result = Model::$db->query($qry);
    return mysqli_fetch_assoc( $result  );
  
}




}
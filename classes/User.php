<?php
class User extends Model
 

{
    const TABLE = 'pst_users';


//All admins / All user / All guest / All moderator

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

}
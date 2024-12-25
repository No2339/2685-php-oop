<?php
class Post
{

    static function all($limit = null)
    {
        $db = new mysqli('localhost', 'root', '', '2685_php_posts');

        $qry = 'SELECT * FROM `pst_posts` WHERE `deleted_at` IS NULL';

        if ($limit) {
            $qry .= " LIMIT $limit";
        }

        $res = $db->query($qry);

        return mysqli_fetch_all($res, MYSQLI_ASSOC);
    }

    static function show($id)
    {
        $db = new mysqli('localhost', 'root', '', '2685_php_posts');

        $qry = "SELECT * FROM `pst_posts` WHERE `deleted_at` IS NULL AND `id` = '$id';";

        $res = $db->query($qry);

        return mysqli_fetch_assoc($res);
    }


    static function store(array $data)
    {
        $db = new mysqli('localhost', 'root', '', '2685_php_posts');

        $title = $data['title'];
        $body = $data['body'];
        $user_id = $data['user_id'];
        $post_status_id = $data['post_status_id'];
        $timestamp = date('Y-m-d h:i:s');

        $qry = "INSERT INTO `pst_posts` 
        (`title`, `body`, `user_id`, `post_status_id`,  `created_at`, `updated_at`) 
        VALUES
        ('$title' , '$body' , '$user_id', '$post_status_id' , '$timestamp' , '$timestamp');";

        $res = $db->query($qry);

        if ($res) {
            $new_post_id = $db->insert_id;

            $data['id'] = $new_post_id;

            return $data;
        }

        return false;
    }

    static function get_count()
    {
        $db = new mysqli('localhost', 'root', '', '2685_php_posts');

        $qry = 'SELECT COUNT(*) AS `count` FROM `pst_posts` WHERE `deleted_at` IS NULL;';

        $res = $db->query($qry);

        return mysqli_fetch_column($res);

    }

}
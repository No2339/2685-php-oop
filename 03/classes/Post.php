<?php

class Post extends Model
{

    // Constant

    const TABLE = 'posts';

    const SOFT_DELETE = false;

    static function store(array $data)
    {

        $title = $data['title'];
        $body = $data['body'];
        $user_id = $data['user_id'];
        $post_status_id = $data['post_status_id'];
        $timestamp = date('Y-m-d h:i:s');

        $qry = "INSERT INTO `pst_posts` 
        (`title`, `body`, `user_id`, `post_status_id`,  `created_at`, `updated_at`) 
        VALUES
        ('$title' , '$body' , '$user_id', '$post_status_id' , '$timestamp' , '$timestamp');";

        $res = self::$db->query($qry);

        if ($res) {
            $new_post_id = self::$db->insert_id;

            $data['id'] = $new_post_id;

            return $data;
        }

        return false;
    }

}
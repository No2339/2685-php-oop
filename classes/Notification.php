<?php
class Notification extends Model
{
    const TABLE = 'notifications';

 
    public static function create($user_id, $message)
    {
        $table = static::TABLE;
        $qry = "INSERT INTO $table (user_id, message) VALUES ($user_id, '$message')";
        return Model::$db->query($qry);
    }
    
    

    
    public static function getUserNotifications($user_id)
    {
        $table = static::TABLE;
        $qry = "SELECT * FROM $table WHERE user_id = $user_id ORDER BY created_at DESC";
        return Model::$db->query($qry);
    }
    


 
    public static function markAsRead($notification_id, $is_read = 1)
    {
        $table = static::TABLE;
        $qry = "UPDATE $table SET is_read = $is_read WHERE id = $notification_id";
        return Model::$db->query($qry);
    }
    
    public static function countUnread($user_id)
    {
        $table = static::TABLE;
        $qry = "SELECT COUNT(*) FROM $table WHERE user_id = $user_id AND is_read = 0";
        $result = Model::$db->query($qry);
            return $result->fetch_column();
       
    }
    
}
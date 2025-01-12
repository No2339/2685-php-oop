<?php

class Auth
{

    // the login
    static function login($email, $password)
    {
        $errors = [];

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        if ($email === false) {
            $errors['email'] = 'Email is not valid';
        }

        $password_valid = preg_match('/[a-z\d\W]{8,16}/i', $password);

        if ($password_valid === 0) {
            $errors['password'] = 'Password should be between 8 and 16 characters';
        }

        if (count($errors) > 0) {
            return $errors;
        }

        $qry = "SELECT * FROM `pst_users` WHERE `email` = '$email';";
        $res = Model::$db->query($qry);
        $user = mysqli_fetch_assoc($res);

        if (!$user) {
            $errors['general'] = 'Invalid credentials!';
            return $errors;
        }

        $password_match = password_verify($password, $user['password']);

        if (!$password_match) {
            $errors['general'] = 'Passwords is not corret';
            return $errors;
        }

        return true;
    }
    // get user role
    public static function getUserRole($email)
    {
        $qry = "SELECT `roles` FROM `pst_users` WHERE `email` = '$email'";
        $result = Model::$db->query($qry);
        return $result->fetch_assoc()['roles'] ?? 'user';
    }
    
    // get user role
    public static function getUserId($email)
    {
        $qry = "SELECT `id` FROM `pst_users` WHERE `email` = '$email'";
        $result = Model::$db->query($qry);
        return $result->fetch_assoc()['id'] ?? null;
    }
    
    
}

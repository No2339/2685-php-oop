<?php

class Auth
{
    static function login($email, $password)
    {
        // Validate email

        $errors = [];

        $email = filter_var($email, FILTER_SANITIZE_EMAIL);
        $email = filter_var($email, FILTER_VALIDATE_EMAIL);

        // Not valid
        if ($email === false) {
            $errors['email'] = 'Email is not valid';
        }

        // Validate password
        $password_valid = preg_match('/[a-z\d\W]{8,16}/i', $password);

        // Not valid
        if ($password_valid === 0) {
            $errors['password'] = 'Password should be between 8 and 16 characters';
        }

        // IF errors
        if (count($errors) > 0) {
            return $errors;
        }


        // Authenticate
        $qry = "SELECT * FROM `pst_users` WHERE `email` = '$email';";

        $res = Model::$db->query($qry);

        $user = mysqli_fetch_assoc($res);

        // Not exists
        if (!$user) {
            $errors['general'] = 'Invalid credinitials!';
            return $errors;
        }

        // If email exists
        // check password
        $password_match = password_verify($password, $user['password']);

        // Passwords do not match
        if (!$password_match) {
            $errors['general'] = 'Invalid credinitials!!!';
            return $errors;
        }

        // if auth, create tokens
        $token = sha1(mt_rand());
        $_SESSION['token'] = $token;
        $_SESSION['roles'] = $user['roles'];

        return true;




    }
}
<?php

function dnd($item, $die = true)
{
    echo '<pre>';
    var_dump($item);
    echo '</pre>';

    if ($die)
        die();
}

function not_permitted()
{
    ?>
    <h2>403 | Authorization Faild</h2>
    <a href="/">Go to Home page</a>
    <?php
}

function authorize($allowed_roles)
{

    $user_role = $_SESSION['roles']; // 'moderator'

    if (!in_array($user_role, $allowed_roles)) {

        header('refresh:5;/');

        return false;
    }

    return true;
}
<?php


if(!isset($_SESSION)) 
{ 
    session_start(); 
} 



if (!isset($_SESSION['token']) && strpos($_SERVER['REQUEST_URI'], '/auth/login.php') === false  ) {

    header('Location: /auth/login.php');
}


require_once 'functions.php';

require_once 'classes/Auth.php';

require_once 'classes/Model.php';

require_once 'classes/Post.php';

require_once 'classes/Reaction.php';

require_once 'classes/User.php';

Model::connct();


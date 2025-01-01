<?php
session_start();

// dd(isset($_SESSION['token']));
// dd(strpos($_SERVER['REQUEST_URI'], 'auth/') === false );

if (!isset($_SESSION['token']) && strpos($_SERVER['REQUEST_URI'], 'auth/') === false  ) {
    // dump('redirect....');
    header('Location: /auth/login.php');
}

require_once 'vendor/autoload.php';

require_once 'functions.php';

Model::connct();
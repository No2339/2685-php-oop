<?php

require_once 'layout/header.php';
$all_users = User::all();
?>

<h1>Users</h1>

<?php
$admins_list = User::admins();


dump($admins_list);


require_once 'layout/footer.php';
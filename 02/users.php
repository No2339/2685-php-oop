<h1>Users</h1>
<?php

require_once 'load.php';

$all_users = User::all();

$admins_list = User::admins();


dd($admins_list);


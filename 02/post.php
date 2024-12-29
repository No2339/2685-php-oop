<h1>Post</h1>

<?php
require_once 'load.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    header('LOCATION: posts.php');
}


$post = Post::show($id);

dd($post);
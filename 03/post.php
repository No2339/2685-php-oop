<h1>Post</h1>

<?php
require_once 'layout/header.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    header('LOCATION: posts.php');
}


$post = Post::show($id);

dump($post);

require_once 'layout/footer.php';
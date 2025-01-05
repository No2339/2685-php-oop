

<?php
require_once 'load.php';

$id = $_GET['id'] ?? '';

if ($id === '') {
    header('LOCATION: posts.php');
}


$posts = Post::show($id);

foreach ($posts as $post) {
    include './posts.php';
}
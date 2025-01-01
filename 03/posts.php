<?php 
require_once 'layout/header.php';
?>

<h1>Posts</h1>

<?php
$posts = Post::all();

dump($posts);

require_once 'layout/footer.php';




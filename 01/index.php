<h1>Dashboard</h1>
<?php

require 'load.php';

$posts = Post::all(5);

$posts_count = Post::get_count();
?>

<h2>All Posts | <?= $posts_count ?></h2>

<h4>Recent</h4>
<?php
foreach ($posts as $post):
    ?>

    <div>
        <h4><?=$post['title'];?></h4>
        <small><?=$post['body'];?></small>

    </div>


    <?php
endforeach;

<?php require_once 'layout/header.php'; ?>

<h1>Dashboard</h1>

<?php


$posts = Post::all(5);

$posts_count = Post::get_count();


$total_comments = Comment::get_count();

$replies_count = Reply::get_count();

$postStatuses = PostStatus::all();

?>

<h2>All Posts | <?= $posts_count ?></h2>

<h4>Recent</h4>
<?php
foreach ($posts as $post):
    ?>

    <div>
        <h4><?= $post['title']; ?></h4>
        <small><?= $post['body']; ?></small>

    </div>


    <?php
endforeach;
?>

<div>
    <p>Your database has <?= $total_comments; ?> comments</p>
</div>

<div>
    <p>Your database has <?= $replies_count; ?> replies</p>
</div>


<div>
    <h3>All Post Statuses</h3>

    <div>
        <?php
        foreach ($postStatuses as $postStatus) {
            $type = $postStatus['type'];
            echo "<h5>$type</h5>";
        }
        ?>
    </div>
</div>

<?php
require_once 'layout/footer.php';
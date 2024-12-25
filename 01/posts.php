<h1>Posts</h1>
<?php 

require 'load.php';


$posts_count = Post::get_count();

$posts = Post::all();



?>

<p>You have <?=$posts_count;?> posts in your database</p>

<?php 

dd($posts);
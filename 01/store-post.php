<h1>Storing post.....</h1>

<?php
include 'load.php';


// Validation

$data = $_POST;

$new_post = [
    "user_id" => $data['user_id'],
    "post_status_id" => $data['post_status_id'],
    "title" => $data['title'],
    "body" => $data['body'],
];


$result = Post::store($new_post);

// Result may be data as array
if ($result) {
    header('Location: post.php?id=' . $result['id']);
} else{
    // Result may be false
    // add errors to session
    header('Location: create-post.php');
}


<?php
session_start();
require_once 'load.php';

$roles = $_SESSION['roles'] ?? 'user';
$user_id = $_SESSION['user_id'] ?? null;

if ($roles === 'admin') {
$posts = Post::all(5);
$posts_count = Post::get_count();
$reaction = reaction::get_total_reactions();
$reactions_by_post= Reaction::reactions_top(5);
$admins = User::get_cast()['rows'];
$total_admins = User::get_cast()['total'];
$total_usres = User::get_cast()['users'];
$total_geust = User::get_cast()['guest'];
$total_moderator = User::get_cast()['moderator'];
} else {
    $user_posts_and_comments = User::getUserPostsAndComments($user_id);
    $unread_count = Notification::countUnread($user_id);
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <?php if ($roles === 'admin') { ?>
        <div class="container mx-auto p-6">
            <!-- Title -->
            <div class="flex justify-between items-center mb-6">
                <h1 class="text-4xl font-bold text-blue-600">Dashboard</h1>
                <div class="space-x-4">
                    <a href="send.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Send Notification</a>
                    <a href="/auth/logout.php" class="bg-red-500 text-white px-4 py-2 rounded hover:bg-red-600 transition">Logout</a>
                </div>
            </div>

            <!-- Stats -->
            <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 gap-6 mb-8">
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Posts</h2>
                    <p class="text-3xl font-bold text-blue-600">📝 <?= $posts_count ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Reactions</h2>
                    <p class="text-3xl font-bold text-green-600">👍 <?= $reaction ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Admins</h2>
                    <p class="text-3xl font-bold text-black">🔑 <?= $total_admins ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Users</h2>
                    <p class="text-3xl font-bold text-black">👥 <?= $total_usres ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Guests</h2>
                    <p class="text-3xl font-bold text-black">👤 <?= $total_geust ?></p>
                </div>
                <div class="bg-white shadow-md rounded-lg p-6">
                    <h2 class="text-xl font-semibold mb-2">All Moderators</h2>
                    <p class="text-3xl font-bold text-black">🧑‍💼 <?= $total_moderator ?></p>
                </div>
            </div>

            <!-- Recent Posts -->
            <h2 class="text-2xl font-bold mb-4">Recent Posts</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <?php foreach ($posts as $post): ?>
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h4 class="text-lg font-semibold text-gray-700">
                            <a href="/post.php?id=<?= $post['user_id'] ?>" class="text-blue-600 hover:underline">
                                <?= $post['title']; ?>
                            </a>
                        </h4>
                        <p class="text-sm text-gray-500"><?= $post['body']; ?></p>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Admins -->
            <h2 class="text-2xl font-bold mb-4">All Admins</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4 mb-8">
                <?php foreach ($admins as $admin): ?>
                    <div class="bg-white shadow-md rounded-lg p-4 flex items-center">
                        <div class="flex-shrink-0 mr-4">
                            <div class="w-12 h-12 bg-blue-100 rounded-full flex items-center justify-center">
                                <span class="text-blue-600 font-bold text-lg"><?= strtoupper(substr($admin['name'], 0, 1)); ?></span>
                            </div>
                        </div>
                        <div>
                            <h4 class="font-semibold text-gray-700"><?= $admin['name']; ?></h4>
                            <p class="text-sm text-gray-500"><?= $admin['email']; ?></p>
                        </div>
                    </div>
                <?php endforeach; ?>
            </div>

            <!-- Top Reactions -->
            <h2 class="text-2xl font-bold mb-4">Top Reactions</h2>
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                <?php foreach ($reactions_by_post as $reaction): ?>
                    <div class="bg-white shadow-md rounded-lg p-4">
                        <h1>Name: <?= $reaction['name']; ?></h1>
                        <h4 class="text-lg font-semibold text-gray-700"><?= $reaction['title']; ?></h4>
                        <p class="text-sm text-gray-500">
                            <span class="text-green-600 font-bold">
                                <?php 
                                    switch ($reaction['type']) {
                                        case 'Love': echo '❤️'; break;
                                        case 'Care': echo '🤗'; break;
                                        case 'Sad': echo '😢'; break;
                                        case 'Like': echo '👍'; break;
                                        case 'Happy': echo '😄'; break;
                                        case 'Laugh': echo '😂'; break;
                                        default: echo '❓'; break;
                                    }
                                ?>
                            </span>
                            <?= $reaction['total_reactions']; ?>
                        </p>
                    </div>
                <?php endforeach; ?>
            </div>
        </div>
    <?php } else { ?>
        <!-- User -->
        <header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white py-6 mb-8 shadow-lg">
            <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
                <div>
                    <?php if ($user_posts_and_comments): ?>
                        <h1 class="text-3xl font-bold">Welcome, <?= ($user_posts_and_comments[0]['user_name'] ?? ''); ?>!</h1>
                    <?php endif; ?>
                </div>
                <div class="flex items-center space-x-6">
                    <!-- Notification -->
                    <div class="relative">
                        <a href="notification.php" class="text-2xl">🔔</a>
                        <?php if ($unread_count > 0): ?>
                            <span class="absolute left-5 bg-red-500 text-white text-xs rounded-full px-2 py-1"><?= $unread_count; ?></span>
                        <?php endif; ?>
                    </div>
                    <a href="/auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">Log Out</a>
                </div>
            </div>
        </header>
        <section class="bg-white p-6 rounded-lg shadow-md">
            <h2 class="text-2xl font-semibold text-gray-800 mb-6">My Posts and Comments</h2>
            <div class="space-y-6">
                <?php if (!empty($user_posts_and_comments)): ?>
                    <?php foreach ($user_posts_and_comments as $item): ?>
                        <div class="bg-white border border-gray-200 rounded-lg shadow-md p-6">
                            <h3 class="text-lg font-bold text-blue-600 mb-2">Title: <?= ($item['post_title'] ?? 'No Title'); ?></h3>
                            <p class="text-gray-700 mb-4">Body: <?= ($item['post_body'] ?? 'No content available'); ?></p>
                            <?php if (!empty($item['comment_text'])): ?>
                                <div class="bg-gray-50 p-4 rounded-lg shadow-inner mt-4">
                                    <p class="text-gray-800 font-medium"><strong>Comment:</strong></p>
                                    <p class="text-gray-700 mt-2"><?= $item['comment_text']; ?></p>
                                </div>
                            <?php else: ?>
                                <p class="text-gray-500 mt-4">No comments on this post.</p>
                            <?php endif; ?>
                        </div>
                    <?php endforeach; ?>
                <?php else: ?>
                    <p class="text-gray-500 text-center">No posts or comments to display.</p>
                <?php endif; ?>
            </div>
        </section>
    <?php } ?>
</body>
</html>



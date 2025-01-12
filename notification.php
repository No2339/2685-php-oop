<?php
session_start();
require_once 'load.php';

$roles = $_SESSION['roles'] ?? 'user';
$user_id = $_SESSION['user_id'] ?? null;

if ($roles === 'admin') {
    // Admin-specific logic can go here
} else {
    $unread_count = Notification::countUnread($user_id);
    $user_posts_and_comments = User::getUserPostsAndComments($user_id);
    $user_notifications = Notification::getUserNotifications($user_id);
}

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['mark_as_read'])) {
    $notification_id = intval($_POST['notification_id']);
    Notification::markAsRead($notification_id);
    header('Location: notification.php');
    return true;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.tailwindcss.com"></script>
    <title>Notification Page</title>
</head>
<body class="bg-gray-100 text-gray-800">

<!-- Header -->
<header class="bg-gradient-to-r from-blue-600 to-indigo-600 text-white p-6 rounded-lg shadow-lg mb-8">
    <div class="max-w-7xl mx-auto px-6 flex justify-between items-center">
        <?php if (!empty($user_posts_and_comments)): ?>
            <h1 class="text-3xl font-bold">
                Welcome, <?= htmlspecialchars($user_posts_and_comments[0]['user_name']); ?>!
            </h1>
            <p class="mt-2 text-lg">
                You have <?= htmlspecialchars($unread_count); ?> notification<?= $unread_count > 1 ? 's' : ''; ?>.
            </p>
        <?php endif; ?>

        <!-- Notification and Logout -->
        <div class="flex items-center space-x-6">
            <div class="relative">
                <a href="/" class="text-2xl">🔔</a>
                <?php if ($unread_count > 0): ?>
                    <span class="absolute top-0 right-6 bg-red-500 text-white text-xs rounded-full px-2 py-1">
                        <?= htmlspecialchars($unread_count); ?>
                    </span>
                <?php endif; ?>
            </div>
            <a href="/auth/logout.php" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-md transition duration-300">
                Logout
            </a>
        </div>
    </div>
</header>

<!-- Roles Notification -->
<div class="container mx-auto p-6">
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
        <?php if ($roles !== 'admin') { ?>
            <section class="w-full">
                <div class="max-w-2xl mx-auto space-y-6">
                    <?php if (!empty($user_notifications)): ?>
                        <?php foreach ($user_notifications as $notification): ?>
                            <div class="p-6 rounded-lg shadow-md <?= $notification['is_read'] ? 'bg-gray-100' : 'bg-white'; ?> border border-gray-200">
                                <p class="font-medium">Message:</p>
                                <p class="bg-white p-4 rounded-lg shadow-inner mt-4">
                                    <?= htmlspecialchars($notification['message']); ?>
                                </p>
                                <p class="text-sm text-gray-500 mt-2">
                                    Sent on: <?= htmlspecialchars($notification['created_at']); ?>
                                </p>
                                <p class="text-sm text-gray-500">
                                    Status:
                                    <span class="<?= $notification['is_read'] ? 'text-green-600' : 'text-red-500'; ?>">
                                        <?= $notification['is_read'] ? 'Read' : 'Unread'; ?>
                                    </span>
                                </p>
                                <?php if (!$notification['is_read']): ?>
                                    <form method="POST" class="mt-4 text-center">
                                        <input type="hidden" name="notification_id" value="<?= htmlspecialchars($notification['id']); ?>">
                                        <button 
                                            type="submit" 
                                            name="mark_as_read" 
                                            class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-6 rounded-md transition duration-300">
                                            Mark as Read
                                        </button>
                                    </form>
                                <?php endif; ?>
                            </div>
                        <?php endforeach; ?>
                    <?php else: ?>
                        <p class="text-gray-600 text-center text-lg">
                            No notifications available for you.
                        </p>
                    <?php endif; ?>
                </div>
            </section>
        <?php } ?>
    </div>
</div>

</body>
</html>

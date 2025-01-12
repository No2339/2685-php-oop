<?php
session_start();
require_once 'load.php';

$roles = $_SESSION['roles'] ?? 'user';
$user_id = $_SESSION['user_id'] ?? null;

if ($roles === 'admin') {
    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['send_notification'])) {
        $target_user_id = intval($_POST['user_id']);
        $message = $_POST['message'];
        if (!empty($target_user_id) && !empty($message)) {
            Notification::create($target_user_id, $message);

            echo "<script>alert('Notification sent successfully!');</script>";
        } else {
            echo "<script>alert('Please fill in all fields!');</script>";
        }
    }
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://cdn.tailwindcss.com"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Send Notification</title>
</head>
<body class="bg-gray-100 text-gray-800">
    <div class="container mx-auto p-6">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
            <?php if ($roles === 'admin') { ?>
                <!-- Send Notification -->
                <section class="bg-white p-6 rounded-lg shadow-md">
                    <h2 class="text-2xl font-semibold text-gray-800 mb-4">Send a New Notification</h2>
                    <form action="" method="POST" class="space-y-4">
                        <div>
                            <label for="user_id" class="block text-gray-700 font-medium">User ID:</label>
                            <input 
                                type="number" 
                                name="user_id" 
                                id="user_id" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                placeholder="Enter the User ID"
                                required>
                        </div>
                        <div>
                            <label for="message" class="block text-gray-700 font-medium">Notification Message:</label>
                            <textarea 
                                name="message" 
                                id="message" 
                                class="w-full px-4 py-2 border border-gray-300 rounded-md focus:outline-none focus:ring-2 focus:ring-blue-500" 
                                placeholder="Enter the notification message"
                                required></textarea>
                        </div>
                        <button 
                            type="submit" 
                            name="send_notification" 
                            class="w-full bg-blue-600 text-white py-2 rounded-md hover:bg-blue-700 transition duration-300">
                            Send Notification
                        </button>
                        <div class="text-center">
                            <a href="/index.php" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600 transition-colors">
                                Back to Dashboard
                            </a>
                        </div>
                    </form>
                </section>
            <?php } ?>
        </div>
    </div>
</body>
</html>

<?php
session_start();
require_once '../load.php';

if (isset($_SESSION['token'])) {
    header('Location: /');
    exit();
}

if (isset($_POST['email']) && isset($_POST['password'])) {
    $res = Auth::login($_POST['email'], $_POST['password']);

    if ($res === true) {
       
        $_SESSION['token'] = bin2hex(random_bytes(16)); 
        $_SESSION['roles'] = Auth::getUserRole($_POST['email']);
        $_SESSION['user_id'] = Auth::getUserId($_POST['email']); 
        header('Location: /'); 
        exit();
    }

    $errors = $res;  
}
?>

<title>Login</title>
<script src="https://cdn.tailwindcss.com"></script>

<body class="bg-gray-100 flex items-center justify-center min-h-screen">
    <form action="" method="POST" class="bg-white p-6 rounded-lg shadow-md w-full max-w-sm">
        <h1 class="text-2xl font-bold text-center mb-4">Login</h1>
        
        <div class="mb-4">
            <label for="email" class="block text-gray-700 font-medium mb-2">Email:</label>
            <input 
                type="email" 
                name="email" 
                id="email" 
                class="w-full px-4 py-2 border rounded-md"
            >
            <p class="text-red-500 text-sm mt-1"><?= @$errors['email']; ?></p>
        </div>

        <div class="mb-4">
            <label for="password" class="block text-gray-700 font-medium mb-2">Password:</label>
            <input 
                type="password" 
                name="password" 
                id="password" 
                class="w-full px-4 py-2 border rounded-md"
            >
            <p class="text-red-500 text-sm mt-1"><?= @$errors['password']; ?></p>
        </div>

        <?php if (isset($errors['general'])): ?>
            <p class="text-red-500 text-sm text-center mb-4"><?= $errors['general']; ?></p>
        <?php endif; ?>

        <button 
            type="submit" 
            class="w-full bg-blue-500 text-white py-2 rounded-md hover:bg-blue-600 transition-colors"
        >
            Login
        </button>
    </form>
</body>
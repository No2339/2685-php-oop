<?php
include '../load.php';

// is logged in
if (isset($_SESSION['token']))
    header('location: /');



if (isset($_POST['email']) && isset($_POST['password'])) {

    $res = Auth::login($_POST['email'], $_POST['password']);

    // Logged in successfully
    if ($res === true) {
        // Redirect to home page
        header('Location: /');
    }

    $errors = $res;

    // dd($res);
}

// dump($_POST);
?>



<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>
</head>

<body>
    <form action="" method="POST" novalidate>
        <div>
            <label for="email">Email</label>
            <input type="email" name="email" id="email">
            <p><?= @$errors['email']; ?></p>
        </div>
        <div>
            <label for="password">Password</label>
            <input type="password" name="password" id="password">
            <p><?= @$errors['password']; ?></p>
        </div>

        <p><?= @$errors['general']; ?></p>

        <button>Login</button>

    </form>
</body>

</html>
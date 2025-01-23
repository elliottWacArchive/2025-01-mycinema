<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="../../css/user-page/style.css">
    <link rel="stylesheet" href="../../css/fonts.css">
</head>
<body>
    <h1>Login</h1>
    <form method="POST">
        <h3>Mail</h3>
        <input type="mail" name="mail" id="mail" required>
        <h3>Password</h3>
        <input type="password" name="password" id="password" required>
        <button type="submit">connect</button>
    </form>
</body>
</html>

<?php

if (isset($_POST['mail'])) {
    $mail = $_POST['mail'];
    include '../../sources/user-interface/getId.php';
    $userId = getId($mail);
    if (!$userId) {
        echo "invalid mail";
    }
}

if (isset($userId) && isset($_POST['password'])) {
    session_start();
    include '../../sources/user-interface/checkPassword.php';
    $pwd = $_POST['password'];
    if (checkPassword($userId, $pwd)) {
        $_SESSION['user_id'] = $userId;
        $_SESSION['password'] = $_POST['password'];
        header('Location: userPage.php');
        exit();
    } else {
        echo "invalid password";
    }
}

?>


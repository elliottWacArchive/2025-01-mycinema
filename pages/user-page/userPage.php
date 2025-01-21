<?php
include '../../sources/user-interface/checkPassword.php';
session_start();
if (!isset($_SESSION['user_id']) || !isset($_SESSION['password'])) {
    header('Location: login.php');
    exit();
} else {
    $id = $_SESSION['user_id'];
    $pwd = $_SESSION['password'];
}

if (!checkPassword($id, $pwd)) {
    header('Location: login.php');
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Page</title>
</head>
<body>
    <h1>Welcome : 
        <?php echo htmlspecialchars($id); ?>
    </h1>
    <form method="post" action="">
        <button type="submit" name="logout" value="logout">logout</button>
    </form>

    <?php
    if (isset($_POST['logout'])) {
        include '../../sources/user-interface/logout.php';
        echo "logout";
        logout();
    }
    ?>
</body>
</html>

<?php

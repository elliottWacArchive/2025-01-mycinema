<?php
include '../../sources/user-interface/checkPassword.php';
include '../../sources/user-interface/getUser.php';
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
    <title>Parameter</title>
    <link rel="stylesheet" href="../../css/user-page/style.css">
    <link rel="stylesheet" href="../../css/fonts.css">
    <script src="../../script/user-page/script.js"></script>
</head>
<body>
    <div id="header">
    <a href="userPage.php"><img id="backImg" src="../../img/back.png" alt=""></a>
    <form method="post" action="">
        <button type="submit" name="logout" value="logout">logout</button>
    </form>
    </div>
    <div id="center">
        <div id="parameter">
            <h1>Parameter</h1>
            <div id="parameter-container">
                <div id="info-container">
                    <div class="inline">
                        <h2>id : </h2>
                        <h2 id="idSelector"><?php echo htmlspecialchars($id); ?></h2>
                    </div>
                    <div class="inline">
                        <h2>Firstname : </h2>
                        <h2><?php echo htmlspecialchars(getUser($id, 'firstname')); ?></h2>
                    </div>
                    <div class="inline">
                        <h2>Lastname : </h2>
                        <h2><?php echo htmlspecialchars(getUser($id, 'lastname')); ?></h2>
                    </div>
                    <div class="inline">
                        <h2>Mail : </h2>
                        <h2><?php echo htmlspecialchars(getUser($id, 'email')); ?></h2>
                    </div>
                    <div class="inline">
                        <h2>Password : </h2>
                        <h2>********</h2>
                    </div>
                </div>
                <div id="config-container">
                    <div class="inline">
                        <h2>Change Firstname : </h2>
                        <input type="text" id="firstname" name="firstname">
                        <button id="firstnameValidation">change</button>
                    </div>
                    <div class="inline">
                        <h2>Change Lastname : </h2>
                        <input type="text" id="lastname" name="lastname">
                        <button id="lastnameValidation">change</button>
                    </div>
                    <div class="inline">
                        <h2>Change Mail : </h2>
                        <input type="mail" id="mail" name="email">
                        <button id="mailValidation">change</button>
                    </div>
                    <div class="inline">
                        <h2>Change Password : </h2>
                        <input type="password" id="password" name="password">
                        <button id="passwordValidation">change</button>
                    </div>
                </div>
            </div>
            <div id="alert"></div>
        </div>
    </div>
    <?php
    if (isset($_POST['logout'])) {
        include '../../sources/user-interface/logout.php';
        echo "logout";
        logout();
    }
    ?>
    <div id="footer">
        <div>Elliott</div>
        <div>2025</div>
    </div>
</body>
</html>
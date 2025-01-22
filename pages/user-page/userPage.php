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
    <title>User Page</title>
	<link rel="stylesheet" href="../../css/user-page/style.css">
	<link rel="stylesheet" href="../../css/fonts.css">
</head>
<body>
	<div id="header">
	<h1>Welcome <?php echo htmlspecialchars(getUser($id, 'firstname')); ?> !</h1>
	<img src="../../img/parameter.png" alt="">
	</div>
	<div id="center">
		<div class="movie-container">
			<h2>Movie</h2>
			<div>
				
			</div>
		</div>
	</div>
	<div id="footer">
		<form method="post" action="">
			<button type="submit" name="logout" value="logout">logout</button>
		</form>
	</div>

    <?php
    if (isset($_POST['logout'])) {
        include '../../sources/user-interface/logout.php';
        echo "logout";
        logout();
    }
    ?>
</body>
</html>
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
	<script src="../../script/user-page/script.js"></script>
</head>
<body>
	<div id="header">
	<form method="post" action="">
		<button type="submit" name="logout" value="logout">logout</button>
	</form>
	<h1>Welcome <?php echo htmlspecialchars(getUser($id, 'firstname')); ?> !</h1>
	<img src="../../img/parameter.png" alt="">
	</div>
	<div id="center">
		<h1>Movie</h1>
		<div id="movie-container">
 			<!-- <div class="movie-card">
				<div class="movie-title" style="white-space: nowrap; overflow: hidden; text-overflow: ellipsis; animation: marquee 10s linear infinite;">Spider man</div>
				<img src="https://fr.web.img5.acsta.net/medias/nmedia/00/00/00/33/spiderman.jpg" class="movie-img">
				<div class="movie-session"></div> -->
			</div>
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
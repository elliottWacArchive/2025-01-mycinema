<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<title>Login</title>
</head>
<body>
	<h1>Login</h1>
	<h3>Mail</h3>
	<form method="POST">
		<input type="mail" name="mail" id="mail">
		<h3>Password</h3>
		<input type="password" name="password" id="password">
		<button type="submit">connect</button>
	</form>
</body>
</html>

<?php

include '../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
	$mail = $_POST['mail'];
	$password = $_POST['password'];
	$sql = "SELECT * FROM user WHERE email = '$mail' AND password = '$password'";
	$result = mysqli_query($conn, $sql);
	if (mysqli_num_rows($result) > 0) {
		$row = mysqli_fetch_assoc($result);
		echo 'Welcome ' . $row['firstname'];
	} else {
		echo 'Invalid mail or password';
	}
}

?>


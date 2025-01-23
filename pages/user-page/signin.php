<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Signin</title>
    <link rel="stylesheet" href="../../css/user-page/style.css">
    <link rel="stylesheet" href="../../css/fonts.css">
</head>
<body>
    <h1>Sign In</h1>
    <div class="main-container">
        <form method="post">
            <div>
                <h3>Firstname :</h3><input type="text" name="firstname" id="firstname" required>
            </div>
            <div>
                <h3>Lastname :</h3><input type="text" name="lastname" id="lastname" required>
            </div>
            <div>
                <h3>Mail :</h3><input type="mail" name="mail" id="mail" required>
            </div>
            <div>
                <h3>Password :</h3><input type="password" name="password" id="password" required>
            </div>
            <div>
                <h3>Birtdate :</h3><input type="date" name="birthdate" id="birthdate" required>
            </div>
            <div>
                <h3>Address :</h3><input type="text" name="address" id="address" required>
            </div>
            <div>
                <h3>City :</h3><input type="text" name="city" id="city" required>
            </div>
            <div>
                <h3>Zipcode :</h3><input type="text" name="zipcode" id="zipcode" required>
            </div>
            <div>
                <h3>Country :</h3><input type="text" name="country" id="country" required>
            </div>
            <button type="submit">Submit</button>
        </form>
    </div>
</body>
</html>

<?php

include '../../includes/dbh.inc.php';

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $firstname = $_POST['firstname'];
    $lastname = $_POST['lastname'];
    $mail = $_POST['mail'];
    $password = $_POST['password'];
    $birthdate = $_POST['birthdate'];
    $adress = $_POST['address'];
    $city = $_POST['city'];
    $zipcode = intval($_POST['zipcode']);
    $country = $_POST['country'];

    $check = "SELECT * FROM user WHERE email = '$mail'";
    $checkResult = mysqli_query($conn, $check);
    if (mysqli_num_rows($checkResult) > 0) {
        echo 'User already exist';
    } else {
        $sql = "INSERT INTO `user` 
		(`email`, `password`, `firstname`, `lastname`, `birthdate`, `address`, `zipcode`, `city`, `country`)
		VALUES ('$mail', '$password', '$firstname', '$lastname', '$birthdate 00:00:00.000000', '$adress',
		'$zipcode', '$city', '$country')";
        $result = mysqli_query($conn, $sql);
        if ($result) {
            header('Location: login.php');
            exit();
        } else {
            echo 'Error';
        }
    }
}

?>

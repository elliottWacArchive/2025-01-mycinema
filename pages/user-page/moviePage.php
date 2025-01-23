<?php
include '../../includes/dbh.inc.php';
include '../../sources/user-interface/movieInfo.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Movie Page</title>
    <link rel="stylesheet" href="../../css/user-page/style.css">
    <link rel="stylesheet" href="../../css/fonts.css">
    <script src="../../script/user-page/script.js"></script>
</head>
<body>
<h1>Welcome <?php echo htmlspecialchars($id) ?> !</h1>
</body>
</html>
<?php
include '../../includes/dbh.inc.php';
include '../../sources/user-interface/movieInfo.php';
if (isset($_GET['id'])) {
    $id = $_GET['id'];
    $title = movieInfo($id, "title");
    $director = movieInfo($id, "director");
    $duration = movieInfo($id, "duration");
    $date = movieInfo($id, "date_begin");
    sort($date);
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
<div id="header">
    <a href="userPage.php"><img id="backImg" src="../../img/back.png" alt=""></a>
    <form method="post" action="">
        <button type="submit" name="logout" value="logout">logout</button>
    </form>
</div>
<div id="center">
    <div id="main-container">
        <div class="title"><?php echo htmlspecialchars($title[0]) ?></div>
        <div class="subtitle">By <?php echo htmlspecialchars($director[0]) ?></div>
        <div id="imgCover"></div>
        <div class="subtitle">Duration : <?php echo htmlspecialchars($duration[0]) ?></div>
        <div class="subtitle">Session :</div>
        <div id="session">
            <?php
            foreach ($date as $line) {
                echo "<p>$line</p>";
            }
            ?>
        </div>
    </div>
</div>
<div id="footer">
    <div>Elliott</div>
    <div>2025</div>
</div>
<script>
    getNewPoster("<?php echo $title[0] ?>", "imgCover");
</script>
</body>
</html>
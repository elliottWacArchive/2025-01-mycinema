<?php

function getMovie($pid, $option)
{
    include '../includes/dbh.inc.php';
    $sql = "SELECT * FROM movie JOIN movie_genre ON id = id_movie JOIN genre ON id_genre = genre.id WHERE id_movie = $pid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row[$option];
        }
    } else {
        echo "0 results";
    }
}

if (isset($_GET['id']) && isset($_GET['option'])) {
    getMovie($_GET['id'], $_GET['option']);
}

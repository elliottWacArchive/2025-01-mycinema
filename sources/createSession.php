<?php

function createSession($room, $date, $time, $movieId)
{
    include '../includes/dbh.inc.php';
    $checkSql = "SELECT * FROM `movie_schedule` WHERE `id_room` = '$room' 
	AND `date_begin` = '$date $time:00.000000' AND `id_movie` = '$movieId'";
    $result = $conn->query($checkSql);
    if ($result->num_rows > 0) {
        echo "Session already exists!";
        return;
    }
    $datetime = $date . ' ' . $time . ':00.000000';
    $sql = "INSERT INTO `movie_schedule` (`id_room`, `date_begin`, `id_movie`) 
	VALUES ('$room', '$datetime', '$movieId')";
    $result = $conn->query($sql);
    echo "Session created!";
}

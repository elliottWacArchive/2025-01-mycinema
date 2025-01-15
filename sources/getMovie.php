<?php

function getMovie($pid, $option)
{
    include '../includes/dbh.inc.php';
    $sql = "SELECT *, distributor.name AS 'distname', genre.name AS 'genrename' FROM movie 
	JOIN movie_genre ON id = id_movie 
	JOIN genre ON id_genre = genre.id 
	JOIN distributor ON id_distributor = distributor.id WHERE id_movie = $pid";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row[$option];
        }
    } else {
        echo "0 results";
    }
}

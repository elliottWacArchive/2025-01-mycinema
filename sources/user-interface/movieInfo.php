<?php

function movieInfo($id, $option)
{
    $tab = [];
    include '../../includes/dbh.inc.php';
    $sql = "SELECT *, movie_schedule.id AS shedid FROM movie_schedule 
	JOIN room ON id_room = room.id JOIN movie ON id_movie = movie.id
	WHERE movie.id = $id";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            array_push($tab, $row[$option]);
        }
    }
    return $tab;
}

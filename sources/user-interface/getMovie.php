<?php

function getMovie($date1, $date2)
{
    include '../../includes/dbh.inc.php';
    $sql = "SELECT *, movie_schedule.id AS shedid FROM movie_schedule 
	JOIN room ON id_room = room.id JOIN movie ON id_movie = movie.id
	WHERE date_begin >= '$date1 00:00:00.000000' AND date_begin <= '$date2 23:59:59.000000'";
    $result = $conn->prepare($sql);
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='movie-card'><div class='movie-title'>" . $row["title"] . "</div><div class='movie-img'></div><div id=" . $row["id_movie"] . " class='select-movie'>View</div></div>\n";
        }
    } else {
        echo "No movie found";
    }
}

if (isset($_GET['date1']) && isset($_GET['date2'])) {
    getMovie($_GET['date1'], $_GET['date2']);
}

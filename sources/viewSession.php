<?php

function viewSession($id)
{
    include '../includes/dbh.inc.php';

    $sql = "SELECT *, movie_schedule.id AS shedid FROM movie_schedule 
	JOIN room ON id_room = room.id WHERE id_movie = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<tr><th class='movie-lign' id=" . $row["shedid"]
            . ">Select</th><th>" . $row["number"] . "</th><th>" . $row["name"] . "</th><th>"
            . $row["date_begin"] . "</th><th>" . $row["floor"] . "</th><th>"
            . $row["seats"] . "</th></tr>";
        }
    } else {
        echo "0 results";
    }
}

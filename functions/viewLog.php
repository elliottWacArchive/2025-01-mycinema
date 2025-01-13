<?php

function viewLog($id)
{
    include '../includes/dbh.inc.php';

    $sql = "SELECT * FROM membership JOIN membership_log ON membership.id = membership_log.id_membership 
	JOIN movie_schedule ON id_session = movie_schedule.id 
	JOIN movie ON id_movie = movie.id WHERE id_user = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='log'>" . $row["title"] . "</div>";
        }
    } else {
        echo "0 results";
    }
}

if (isset($_GET['id'])) {
    viewLog($_GET['id']);
} else {
    echo "Error";
}

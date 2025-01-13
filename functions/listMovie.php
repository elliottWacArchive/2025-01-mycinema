<?php

function listMovie($name, $option)
{
    include '../includes/dbh.inc.php';
    $sql = "SELECT * FROM movie JOIN movie_genre ON id = id_movie 
	JOIN genre ON id_genre = genre.id WHERE UPPER($option) LIKE UPPER('%$name%')";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div class='movie' id=" . $row["id_movie"] . ">" . $row["title"] . "</div>";
        }
    } else {
        echo "0 results";
    }
}

if (isset($_GET['title'])) {
    listMovie($_GET['title'], 'title');
} elseif (isset($_GET['director'])) {
    listtMovie($_GET['director'], 'director');
} elseif (isset($_GET['genre'])) {
    listMovie($_GET['genre'], 'name');
}

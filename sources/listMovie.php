<?php

function listMovie($movie, $option, $page, $resultsPerPage)
{
    include '../includes/dbh.inc.php';
    $offset = ($page - 1) * $resultsPerPage;

    $countSql = "SELECT COUNT(*) as total FROM movie 
	JOIN movie_genre ON id = id_movie 
	JOIN genre ON id_genre = genre.id 
	JOIN distributor ON id_distributor = distributor.id 
	WHERE UPPER($option) LIKE UPPER('%$movie%')";
    $sql = "SELECT * FROM movie JOIN movie_genre ON id = id_movie 
	JOIN genre ON id_genre = genre.id 
	JOIN distributor ON id_distributor = distributor.id 
	WHERE UPPER($option) LIKE UPPER('%$movie%') LIMIT $resultsPerPage OFFSET $offset";

    $countResult = $conn->query($countSql);
    $totalResults = $countResult->fetch_assoc()['total'];

    $result = $conn->query($sql);

    $movies = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $movies[] = "<div id='" . $row["id_movie"] . "' class='movie'>" . $row["title"] . "</div>";
        }
    } else {
        $movies[] = "No movies found.";
    }

    echo json_encode(['movies' => $movies, 'totalResults' => $totalResults]);
}

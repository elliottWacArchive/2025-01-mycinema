<?php

function listUser($name, $option, $page, $resultsPerPage)
{
    include '../includes/dbh.inc.php';
    $offset = ($page - 1) * $resultsPerPage;

    if ($option == 'two') {
        $countSql = "SELECT COUNT(*) as total FROM user 
		WHERE CONCAT(UPPER(firstname), ' ' ,UPPER(lastname)) LIKE UPPER('%$name%')";
        $sql = "SELECT * FROM user WHERE CONCAT(UPPER(firstname), ' ' ,UPPER(lastname)) 
		LIKE UPPER('%$name%') LIMIT $resultsPerPage OFFSET $offset";
    } elseif ($option == 'firstname') {
        $countSql = "SELECT COUNT(*) as total FROM user 
		WHERE UPPER(firstname) LIKE UPPER('%$name%')";
        $sql = "SELECT * FROM user WHERE UPPER(firstname) 
		LIKE UPPER('%$name%') LIMIT $resultsPerPage OFFSET $offset";
    } elseif ($option == 'lastname') {
        $countSql = "SELECT COUNT(*) as total FROM user 
		WHERE UPPER(lastname) LIKE UPPER('%$name%')";
        $sql = "SELECT * FROM user WHERE UPPER(lastname) 
		LIKE UPPER('%$name%') LIMIT $resultsPerPage OFFSET $offset";
    }

    $countResult = $conn->query($countSql);
    $totalResults = $countResult->fetch_assoc()['total'];

    $result = $conn->query($sql);

    $users = [];
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            $users[] = "<div id='" . $row["id"] . "' class='user'>" . $row["firstname"] . " "
            . $row["lastname"] . "</div>";
        }
    } else {
        $users[] = "no user found.";
    }

    echo json_encode(['users' => $users, 'totalResults' => $totalResults]);
}

<?php

function listUser($name, $option)
{
    include '../includes/dbh.inc.php';
    if ($option == 'two') {
        $sql = "SELECT * FROM user WHERE CONCAT(UPPER(firstname), ' ' ,UPPER(lastname)) LIKE UPPER('%$name%')";
    } elseif ($option == 'firstname') {
        $sql = "SELECT * FROM user WHERE UPPER(firstname) LIKE UPPER('%$name%')";
    } elseif ($option == 'lastname') {
        $sql = "SELECT * FROM user WHERE UPPER(lastname) LIKE UPPER('%$name%')";
    }

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo "<div id=" . $row["id"] . " class='user'>" . $row["firstname"] . " " . $row["lastname"] . "</div>";
        }
    } else {
        echo "0 results";
    }
}

if (isset($_GET['two'])) {
    listUser($_GET['two'], 'two');
} elseif (isset($_GET['firstname'])) {
    listUser($_GET['firstname'], 'firstname');
} elseif (isset($_GET['lastname'])) {
    listUser($_GET['lastname'], 'lastname');
}

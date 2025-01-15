<?php

function getUser($id, $option)
{
    include '../includes/dbh.inc.php';
    $sql = "SELECT * FROM user WHERE id = $id";

    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row[$option];
        }
    } else {
        echo "0 results";
    }
}

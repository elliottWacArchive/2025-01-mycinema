<?php

function changerUser($id, $option, $value)
{
    include '../../includes/dbh.inc.php';
    $sql = "UPDATE user SET $option = '$value' WHERE id = $id";
    if ($conn->query($sql) === true) {
        echo "$option changed to $value.";
    } else {
        echo "Error: " . $conn->error;
    }
}

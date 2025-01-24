<?php

function getUser($id, $option)
{
    include '../../includes/dbh.inc.php';
    $checkSql = "SELECT * FROM `user` WHERE `id` = $id";
    $result = $conn->query($checkSql);
    if ($result->num_rows > 0) {
        return $result->fetch_assoc()[$option];
    } else {
        return false;
    }
}

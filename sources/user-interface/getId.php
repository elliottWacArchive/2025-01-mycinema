<?php

function getId($mail)
{
    include '../../includes/dbh.inc.php';
    $checkSql = "SELECT * FROM `user` WHERE `email` = '$mail'";
    $result = $conn->query($checkSql);
    if ($result->num_rows == 1) {
        return $result->fetch_assoc()['id'];
    } else {
        return false;
    }
}

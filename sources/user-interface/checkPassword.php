<?php

function checkPassword($id, $password)
{
    include '../../includes/dbh.inc.php';
    $checkSql = "SELECT * FROM `user` WHERE `id` = $id AND `password` LIKE '$password'";
    $result = $conn->query($checkSql);
    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row[$option];
        }
        return true;
    } else {
        return false;
    }
}

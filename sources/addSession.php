<?php

function addSession($id, $userId)
{
    include '../includes/dbh.inc.php';
    $getId = "SELECT id FROM membership WHERE id_user = '$userId'";
    $idResult = $conn->query($getId);
    if ($idResult->num_rows > 0) {
        $row = $idResult->fetch_assoc();
        $userId = $row['id'];
    } else {
        echo "Membership not found for user!";
        return;
    }
    $checkSql = "SELECT * FROM `membership_log` WHERE `id_membership` = '$userId' AND `id_session` = '$id'";
    $result = $conn->query($checkSql);
    if ($result->num_rows > 0) {
        echo "You have already signed up for this session!";
    } else {
        $sql = "INSERT INTO `membership_log` (`id_membership`, `id_session`) VALUES ('$userId', '$id')";
        $result = $conn->query($sql);
        echo "You have successfully signed up for this session! $userId, $id";
    }
}

<?php

function editSub($id, $sub)
{
    include '../includes/dbh.inc.php';
    $checkSql = "SELECT * FROM membership WHERE id_user = $id";
    $result = $conn->query($checkSql);

    if ($result->num_rows > 0) {
        if ($sub > 0) {
            $sql = "UPDATE membership SET id_subscription = '$sub', date_begin = current_timestamp() 
			WHERE id_user = $id";
        } else {
            // supprime les enregistrements dépendants dans membership_log
            $deleteLogSql = "DELETE FROM membership_log 
			WHERE id_membership = (SELECT id FROM membership WHERE id_user = $id)";
            if ($conn->query($deleteLogSql) !== true) {
                echo "Error: " . $deleteLogSql . "\n" . $conn->error;
                return;
            }
            $sql = "DELETE FROM membership WHERE id_user = $id";
        }
    } else {
        if ($sub > 0) {
            $sql = "INSERT INTO membership (`id_user`, `id_subscription`, `date_begin`) 
			VALUES ('$id', '$sub', current_timestamp())";
        } else {
            echo "User not found and no subscription to delete.";
            return;
        }
    }
    if ($conn->query($sql) === true) {
        echo "user : " . $id . " sub : " . $sub;
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
}

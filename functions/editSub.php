<?php

function editSub($id, $sub)
{
    include '../includes/dbh.inc.php';
    if ($sub > 0) {
        $sql = "INSERT INTO membership (`id_user`, `id_subscription`, `date_begin`) VALUES ('$id', '$sub', current_timestamp())";
    } else {
        $sql = "DELETE FROM membership WHERE id_user = $id";
    }
    if ($conn->query($sql) === true) {
        echo "user : " . $id . " sub : " . $sub;
    } else {
        echo "Error: " . $sql . "\n" . $conn->error;
    }
}

if (isset($_GET['id']) && isset($_GET['sub'])) {
    editSub($_GET['id'], $_GET['sub']);
} else {
    echo "Error";
}

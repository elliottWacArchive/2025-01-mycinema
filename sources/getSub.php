<?php

function getSub($id)
{
    include '../includes/dbh.inc.php';
    $sql = "SELECT * FROM membership 
	JOIN subscription ON membership.id_subscription = subscription.id WHERE id_user = $id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
            echo $row["name"] . ". " . $row["description"] . ". Price : " . $row["price"]
            . "$. For : " . $row["duration"] . " days. Since : " . $row["date_begin"] . ".";
        }
    } else {
        echo "Not sub.";
    }
}

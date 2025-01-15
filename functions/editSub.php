<?php

require '../sources/editSub.php';

if (isset($_GET['id']) && isset($_GET['sub'])) {
    editSub($_GET['id'], $_GET['sub']);
} else {
    echo "Error";
}

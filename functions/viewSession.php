<?php

require '../sources/viewSession.php';

if (isset($_GET['id'])) {
    viewSession($_GET['id']);
} else {
    echo "Error";
}

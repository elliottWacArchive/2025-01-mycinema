<?php

require '../sources/searchSession.php';

if (isset($_GET['date']) && isset($_GET['time'])) {
    searchSession($_GET['date'], $_GET['time']);
} else {
    echo "Error";
}

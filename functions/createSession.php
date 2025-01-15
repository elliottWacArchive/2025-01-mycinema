<?php

require '../sources/createSession.php';

if (isset($_GET['room']) && isset($_GET['date']) && isset($_GET['time']) && isset($_GET['movieId'])) {
    createSession($_GET['room'], $_GET['date'], $_GET['time'], $_GET['movieId']);
} else {
    echo "Error";
}

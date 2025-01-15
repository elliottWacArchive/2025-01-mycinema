<?php

require '../sources/addSession.php';

if (isset($_GET['id']) && isset($_GET['userid'])) {
    addSession($_GET['id'], $_GET['userid']);
} else {
    echo "Error";
}

<?php

require '../sources/viewLog.php';

if (isset($_GET['id'])) {
    viewLog($_GET['id']);
} else {
    echo "Error";
}

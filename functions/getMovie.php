<?php

require '../sources/getMovie.php';

if (isset($_GET['id']) && isset($_GET['option'])) {
    getMovie($_GET['id'], $_GET['option']);
}

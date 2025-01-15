<?php

require '../sources/getUser.php';

if (isset($_GET['id'], $_GET['option'])) {
    getUser($_GET['id'], $_GET['option']);
}

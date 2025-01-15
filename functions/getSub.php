<?php

require '../sources/getSub.php';

if (isset($_GET['id'])) {
    getSub($_GET['id']);
}

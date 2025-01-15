<?php

require '../sources/listUser.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$resultsPerPage = isset($_GET['resultsPerPage']) ? (int)$_GET['resultsPerPage'] : 10;

if (isset($_GET['two'])) {
    listUser($_GET['two'], 'two', $page, $resultsPerPage);
} elseif (isset($_GET['firstname'])) {
    listUser($_GET['firstname'], 'firstname', $page, $resultsPerPage);
} elseif (isset($_GET['lastname'])) {
    listUser($_GET['lastname'], 'lastname', $page, $resultsPerPage);
}

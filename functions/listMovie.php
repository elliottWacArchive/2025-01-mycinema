<?php

require '../sources/listMovie.php';

$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
$resultsPerPage = isset($_GET['resultsPerPage']) ? (int)$_GET['resultsPerPage'] : 10;

if (isset($_GET['title'])) {
    listMovie($_GET['title'], 'title', $page, $resultsPerPage);
} elseif (isset($_GET['genrename'])) {
    listMovie($_GET['genrename'], 'genre.name', $page, $resultsPerPage);
} elseif (isset($_GET['director'])) {
    listMovie($_GET['director'], 'director', $page, $resultsPerPage);
} elseif (isset($_GET['distname'])) {
    listMovie($_GET['distname'], 'distributor.name', $page, $resultsPerPage);
}

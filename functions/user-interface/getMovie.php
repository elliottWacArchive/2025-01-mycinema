<?php

require '../../sources/user-interface/getMovie.php';

if (isset($_GET['date1']) && isset($_GET['date2'])) {
    getMovie($_GET['date1'], $_GET['date2']);
}

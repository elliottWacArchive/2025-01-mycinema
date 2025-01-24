<?php

require '../../sources/user-interface/changeUser.php';

if (isset($_GET['id']) && isset($_GET['option']) && isset($_GET['value'])) {
    changerUser($_GET['id'], $_GET['option'], $_GET['value']);
}

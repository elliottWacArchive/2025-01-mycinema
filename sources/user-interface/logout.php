<?php

function logout()
{
    session_start();
    session_unset();
    session_destroy();
    header("Location: ../../pages/user-page/login.php");
    exit();
}

<?php


if (!isset($_COOKIE["lastLog"])){
    session_destroy();
    header("location: ../login.html");
    exit();
} else {
    $lastLog = $_COOKIE["lastLog"];
}

?>
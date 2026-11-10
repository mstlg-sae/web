<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
session_destroy();
# option de redirection si besoin pour les deconnection
if (isset($_GET['redirect']) && $_GET['redirect'] == TRUE) {
    if (isset($_GET['location'])) {
        $location = $_GET['location'];
    } else {
        $location = "./../index.html";
    }
    header("location: ".$location);
    exit;
}

?>
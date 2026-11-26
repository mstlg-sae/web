<?php
if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
$_SESSION["nb1"] = random_int(1, 10);
$_SESSION["nb2"] = random_int(1, 10);
?>


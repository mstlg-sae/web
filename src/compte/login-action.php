<?php
if (isset($_POST["mdp"] && $_POST["login"])){
    $login = $_POST["login"];
    $password_hash = md5($_POST["mdp"]);
    sql_request = "SELECT * FROM USERS WHERE login='".$login."' AND password='".$password_hash."'"
    sql_request_role = "SELECT role from ROLE WHERE login=".$login
}

?>
<?php
session_start();
include("./../function/php_lib.php");
profil_page_onlogged("");
if (isset($_POST["mdp"]) && isset($_POST["login"]) && isset($_POST["mdp_repeat"])){
    if ($_POST["mdp_repeat"] == $_POST["mdp"]) {
        $connect = connecter("localhost","root","!sae26!");
        if ($connect){
            $db = mysqli_select_db($connect, $base);
            if ($db) {
                $login = mysqli_real_escape_string($connect, $_POST["login"]); # fix faille sql
                $password_hash = md5($_POST["mdp"]);
                $sql_request = "SELECT COUNT(USERNAME) FROM ".$table_user." WHERE username='".$login."';";
                $sql_request_create_user = "INSERT INTO ".$table_user." (`username`, `password`) VALUES (".$login.", ".$password_hash.");";
                $sql_request_create_user_role = "INSERT INTO ".$table_role." (`username`, `role`) VALUES (".$login.", ".$base_role_signup.");";
                $rq = mysqli_query($connect, $sql_request);
                $check_login = $rq ? mysqli_fetch_row($rq) : NULL;
                if ($check_login != NULL){
                    if ($check_login[0]==0){
                        echo 'good';
                    } else {
                       header("Location: inscription.php?error=login_already_used"); 
                    }
                } else {
                    header("Location: inscription.php?error=no_db_available");
                    exit;   
                }
            } else {
                header("Location: inscription.php?error=no_db_available");
                exit;
            }
        } else {
            header("Location: inscription.php?error=no_db_available");
            exit;
        }
    } else {
        header("Location: inscription.php?error=password_not_same");
        exit;
    }
} else {
    header("Location: inscription.php?error=no_request");
    exit;
}
?>
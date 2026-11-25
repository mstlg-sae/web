<?php
session_start();
include("./../function/php_lib.php");
if (isset($_POST["mdp"]) && isset($_POST["login"]) && isset($_POST["mdp_new"])){
    $connect = connecter("localhost","root","!sae26!");
    if ($connect){
        $db = mysqli_select_db($connect, $base);
        if ($db){
            $login = mysqli_real_escape_string($connect, $_POST["login"]);
            $password_hash = md5($_POST["mdp"]);
            $password_hash_new = md5($_POST["mdp_new"]);
            $sql_request = "SELECT * FROM ".$table_user." WHERE username='".$login."' AND password='".$password_hash."'";
            $sql_request_role = "SELECT role from ".$table_role." WHERE username='".$login."'";
            $sql_request_update = "UPDATE ".$table_user." SET password = ? WHERE username = '".$login."'"; # login deja escape  
            $statment_update = $connect->prepare($sql_request_update);
            if (!$statment_update) {
                disconnect($connect);
                header("Location: reset_mdp.php?error=no_db_available");
                exit;
            }
            $statment_update -> bind_param("s",$password_hash_new);
            $rq = mysqli_query($connect, $sql_request);
            $rq_role = mysqli_query($connect, $sql_request_role);
            $actual_user = $rq ? mysqli_fetch_row($rq) : NULL;
            if ($actual_user != NULL){
                $_SESSION["login"] = $login;
                $actual_role = $rq_role ? mysqli_fetch_row($rq_role) : NULL;
                if ($actual_role != NULL){
                    $_SESSION['role'] = $actual_role[0];
                    if ($statment_update->execute()) {
                        # deconnection de l'utilisateur puis renvoie sur la page de connection (index.php)
                        # la page de connection est uniquement accessible au non connecté donc on deconnecte
                        disconnect($connect);
                        include("./logout.php");
                        header("Location: index.php?info=sucess_change_mdp");
                        exit;
                    } else {
                        disconnect($connect);
                        header("Location: reset_mdp.php?error=no_db_available");
                        exit;
                    }
                } else {
                    # cas de l'echec du chargement du rôle, on deconnect puis renvoie erreur sur la page de connection ( Connection incomplète )
                    # Chargement du code la page de deconnection mais sans un double renvoie logout.php -> index.php
                    include("./logout.php");
                    # renvoie page de connection avec erreur dédié
                    header("Location: reset_mdp.php?error=no_role");
                    exit;
                }
            } else {
                disconnect($connect);
                header("Location: reset_mdp.php?error=wrong_login");
                exit;
            }
        } else {
            disconnect($connect);
            header("Location: reset_mdp.php?error=no_db_available");
            exit;
        }
    } else {
        header("Location: reset_mdp.php?error=no_db_available");
        exit;
    }
} else {
    header("Location: reset_mdp.php?error=no_request");
    exit;
}
?>
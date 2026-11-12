<?php
session_start();
include("./../function/php_lib.php");
profil_page_onlogged("./");
if (isset($_POST["mdp"]) && isset($_POST["login"]) && isset($_POST["mdp_repeat"])){
    if ($_POST["mdp_repeat"] == $_POST["mdp"]) {
        $connect = connecter("localhost","root","!sae26!");
        if ($connect){
            $db = mysqli_select_db($connect, $base);
            if ($db) {
                # Preparation de requète de check, et les requète d'insertion d'utilisateur et de son roel
                $password_hash = md5($_POST["mdp"]);
                # requète de check si l'utilisateur n'existe pas
                $sql_request = "SELECT COUNT(username) FROM ".$table_user." WHERE username= ?;";
                $statment_check = $connect->prepare($sql_request);
                $statment_check -> bind_param("s",$login);
                # Requète de création d'utilisateur
                $sql_request_create_user = "INSERT INTO ".$table_user." (`username`, `password`) VALUES (?,?);";
                $statment_create_user = $connect->prepare($sql_request_create_user);
                $statment_create_user -> bind_param("ss",$login,$password_hash);
                # Requète de création de rôle à l'utilisateur
                $sql_request_create_user_role = "INSERT INTO ".$table_role." (`username`, `role`) VALUES (?,?);";
                $statment_create_user_role = $connect->prepare($sql_request_create_user_role);
                $statment_create_user_role -> bind_param("ss",$login,$base_role_signup);
                # Execution de requète dit de check
                mysqli_stmt_execute($statment_check); 
                $result = mysqli_stmt_get_result($statment_check);
                if ($result == false) {
                    disconnect($connect);
                    header("Location: inscription.php?error=error_db");
                    exit;
                }
                $check_login = $result->fetch_row();
                if ($check_login != NULL){
                    if ($check_login[0]==0){
                        # creation de l'utilisateur
                        mysqli_stmt_execute($statment_create_user);
                        $result_create_user = mysqli_stmt_get_result($statment_create_user);
                        if ($result_create_user==TRUE){
                            mysqli_stmt_execute($statment_create_user_role);
                            $result_create_user_role = mysqli_stmt_get_result($statment_create_user_role);
                            if ($result_create_user_role){
                                # success
                                disconnect($connect);
                                header("Location: index.php?info=sucess_signup");
                                exit;
                            } else {
                                disconnect($connect);
                                header("Location: inscription.php?error=fatal_error_db");
                                exit; 
                            }
                        } else {
                            disconnect($connect);
                            header("Location: inscription.php?error=error_db");
                            exit;
                        }
                    } else {
                        disconnect($connect);
                        header("Location: inscription.php?error=login_already_used");
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
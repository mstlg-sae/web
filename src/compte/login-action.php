<?php
include("./../function/php_lib.php");
if (isset($_POST["mdp"]) && isset($_POST["login"])){
    $base = "sae";
    $table_user = "Users";
    $table_role = "role";
    $connect = connecter("localhost","root","!sae26!");
    if ($connect){
        $db = mysqli_select_db($connect, $base);
        if ($db){
            $login = mysqli_real_escape_string($connect, $_POST["login"]);
            $password_hash = md5($_POST["mdp"]);
            $sql_request = "SELECT * FROM ".$table_user." WHERE username='".$login."' AND password='".$password_hash."'";
            $sql_request_role = "SELECT role from ".$table_role." WHERE username='".$login."'";
            $rq = mysqli_query($connect, $sql_request);
            $rq_role = mysqli_query($connect, $sql_request_role);
            echo "DEBUG rq="; var_dump($rq);
            echo "DEBUG mysqli_error="; var_dump(mysqli_error($connect));
            echo "DEBUG num_rows="; var_dump(mysqli_num_rows($rq));
            $actual_user = $rq ? mysqli_fetch_row($rq) : NULL;
            if ($actual_user != NULL){
                session_start();
                $_SESSION["login"] = $login;
                $actual_role = $rq_role ? mysqli_fetch_row($rq_role) : NULL;
                if ($actual_role != NULL){
                    $_SESSION['role'] = $actual_role[0];
                    if ($actual_role[0]=='adminsys'){
                        header("Location: adminsys.php");
                        exit;
                    }
                    elseif ($actual_role[0]=='adminweb'){
                        header("Location: adminweb.php");
                        exit;
                    } else {
                        header("Location: profil.php");
                        exit;
                    }
                } else {
                    # cas de l'echec du chargement du rôle, on deconnect puis renvoie erreur sur la page de connection ( Connection incomplète )
                    # Chargement du code la page de deconnection mais sans un double renvoie logout.php -> index.php
                    include("./logout.php");
                    # renvoie page de connection avec erreur dédié
                    header("Location: index.php?error=no_role");
                    exit;
                }
            } else {
                disconnect($connect);
                #header("Location: index.php?error=wrong_login");
                #exit;
            }
        } else {
            disconnect($connect);
            header("Location: index.php?error=no_db_available");
            exit;
        }
    } else {
        header("Location: index.php?error=no_db_available");
        exit;
    }
} else {
    header("Location: index.php?error=no_request");
    exit;
}
?>
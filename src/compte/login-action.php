<?php
include("./../function/php_lib.php");
if (isset($_POST["mdp"]) && isset($_POST["login"])){
    $base = "sae";
    $table_user = "Users";
    $table_role = "role";
    $login = $_POST["login"];
    $password_hash = md5($_POST["mdp"]);
    $sql_request = "SELECT * FROM ".$table_user." WHERE login='".$login."' AND password='".$password_hash."'";
    $sql_request_role = "SELECT role from ".$table_role." WHERE login='".$login."'";
    $connect = silent_connecter("localhost","root","");
    $db = mysqli_select_db($connect, $base);
    $rq = mysqli_query($connect, $sql_request);
    $rq_role = mysqli_query($connect, $sql_request_role);
    if ($db){
        while ($actual_user = mysqli_fetch_row($rq)) {
            if ($actual_user[0] == $login && $actual_user[1] == $password_hash) {
                session_start();
                $_SESSION["login"] = $login;
                break;
            }
        }
        if (session_status() == PHP_SESSION_ACTIVE){
            # connection reussie -> Acquisition du rôle de l'utilisateur et renvoie sur sa page de rôle
            $actual_role = mysqli_fetch_row($rq_role);
            if ($actual_role != NULL) {
                $_SESSION['role'] = $actual_role[0];
                if (isset($_SESSION['role'])){
                    # Note j'utilise $actual_role car les deux sont les meme et c'ets plus facile a écrire
                    if ($actual_role[0]=='adminsys')
                        header("Location: adminsys.php");
                    elseif ($actual_role[0]=='adminweb'){
                        header("Location: adminweb.php");
                    } else {
                        header("Location: profil.php");
                    }
                }
            } else {
                # cas de l'echec du chargement du rôle, on deconnect puis renvoie erreur sur la page de connection ( Connection incomplète )
                # Chargement du code la page de deconnection mais sans un double renvoie logout.php -> index.php
                include("./logout.php");
                # renvoie page de connection avec erreur dédié
                header("Location: index.php?error=no_role");
            }
        } else {
            disconnect($connect);
            header("Location: index.php?error=wrong_login");
        }
        
    } else {
        header("Location: index.php?error=no_db_available");
    }
} else {
    header("Location: index.php?error=".$_POST["mdp"].$_POST["login"]);
    #header("Location: index.php?error=no_request");
}

?>

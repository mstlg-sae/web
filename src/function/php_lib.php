<?php
function display($a) {
	echo "<pre>";
	print_r($a);
	echo "</pre>";
}
function dump($a) {
	echo "<pre>";
	var_dump($a);
	echo "</pre>";
}
function connecter_debug($host=NULL, $user=NULL, $pass=NULL){
    if (func_num_args()==0){
        $connection = @mysqli_connect();
    }
    else{
        $connection = @mysqli_connect($host, $user, $pass);
    }
    if ($connection){
        echo "<p>Connexion réussi</p>";
        echo "<p>Informatiqn sur le serveur".mysqli_get_host_info($connection)." </p>";
        echo "<p>Version du serveur : <b>".mysqli_get_server_info($connection)."</b></p>";
        echo "<p>Jeu de caratères ".mysqli_character_set_name($connection)."</p>";

    } else {
        echo "<p>Erreur lors de l'ouverture de la connexion</p>";
        echo "<p>numéro de l'erreur ".mysqli_connect_errno()."</p>";
        echo "<p>erreur : ".mysqli_connect_error()."</p>";
    }
    mysqli_set_charset($connection, "utf8mb4")
    return $connection;
}
function disconnect_debug($connection=NULL){
    if ($connection){
        $ok = mysqli_close($connection);
        if ($ok){
            echo "Déconnextion réussi";
        }
        else{
            echo "Erreur lors de la déconnexion";
        }
    } else {
        echo "<p>Erreur lors de la connexion, la connexion n'existe pas</p>";
    }
}
function disconnect($connection=NULL){
    if ($connection){
        $ok = mysqli_close($connection);
    }
}
function connecter($host=NULL, $user=NULL, $pass=NULL){
    if (func_num_args()==0){
        $connection = @mysqli_connect();
    }
    else{
        $connection = @mysqli_connect($host, $user, $pass);
    }
    mysqli_set_charset($connection, "utf8mb4")
    return $connection;
}
function is_logged_redirect($login_page_location){
    # Fonction qui renvoie sur la page de connection si l'utilisateur n'est pas connecter, 
    # INPUT
    # $login_page_location = Position de la page de connection par rapport à l'appel de la fonciton
    if (session_status() != PHP_SESSION_ACTIVE){
        header("Location:".$login_page_location);
    }
}
?>


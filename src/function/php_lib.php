<?php
mysqli_report(MYSQLI_REPORT_OFF);
# -----
# Variable global de tables et de bdd
$base = "sae";
$table_user = "Users";
$table_role = "role";
$base_role_signup = "user";
# -----
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
        mysqli_set_charset($connection, "utf8mb4");
        echo "<p>Connexion réussi</p>";
        echo "<p>Informatiqn sur le serveur".mysqli_get_host_info($connection)." </p>";
        echo "<p>Version du serveur : <b>".mysqli_get_server_info($connection)."</b></p>";
        echo "<p>Jeu de caratères ".mysqli_character_set_name($connection)."</p>";

    } else {
        echo "<p>Erreur lors de l'ouverture de la connexion</p>";
        echo "<p>numéro de l'erreur ".mysqli_connect_errno()."</p>";
        echo "<p>erreur : ".mysqli_connect_error()."</p>";
    }
    
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
    if ($connection){
        mysqli_set_charset($connection, "utf8mb4");
    }
   
    return $connection;
}
function is_logged(){
    # Fonction qui renvoie sur la page de connection si l'utilisateur n'est pas connecter, 
    # INPUT
    # $login_page_location = Position de la page de connection par rapport à l'appel de la fonciton
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['login'])) {
        return 1;
    }
    return 0;
}
function inject_profil_button($compte_location){
    if (is_logged()==1){
        $text = 'Profil';
        if ($_SESSION['role']=='adminsys'){
            
            $page = $compte_location.'adminsys.php';
        } elseif($_SESSION['role']=='adminweb'){
            $page = $compte_location.'adminweb.php';
        } else {
            $page = $compte_location.'profil.php';
        }
        
    } else {
        $text = 'Connexion';
        $page = $compte_location.'index.php';
    }
    echo "<a href='".$page."' class='actif'>".$text."</a>";
}
function is_logged_redirect($login_page_location){
    # Fonction qui renvoie sur la page de connection si l'utilisateur n'est pas connecter, 
    # INPUT
    # $login_page_location = Position de la page de connection par rapport à l'appel de la fonciton
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['login'])) {
        header("Location: " . $login_page_location);
        exit;
    }
}
function profil_page_onlogged($compte_location){
    # Fonction qui renvoie sur la page de compte si l'utilisateur est connectée, 
    # INPUT
    # $login_page_location = Position du dossier de compte du site
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (isset($_SESSION['login']) && isset($_SESSION['role'])) {
        if ($_SESSION['role'] == 'adminsys'){
            header("Location: " . $compte_location."adminsys.php");
        } elseif ($_SESSION['role'] == 'adminweb'){
            header("Location: " . $compte_location."adminweb.php");
        } else{
            header("Location: " . $compte_location."profil.php");
            
        }
        exit;
    }
}
function right_profil_page($login_page_location, $role_required){
    if (session_status() === PHP_SESSION_NONE) {
        session_start();
    }
    if (!isset($_SESSION['login']) || !isset($_SESSION['role'])) {
        return;
    }
    if ($_SESSION['role'] !== $role_required) {
        if ($_SESSION['role'] === 'adminsys') {
            header("Location: " . $login_page_location . "adminsys.php");
        } elseif ($_SESSION['role'] === 'adminweb') {
            header("Location: " . $login_page_location . "adminweb.php");
        } else {
            header("Location: " . $login_page_location . "profil.php");
        }
        exit;
    }
}
?>


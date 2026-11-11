<?php
session_start();
include("./../function/php_lib.php");
profil_page_onlogged("");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Connexion · BIT//ARCADE</title>
  <link rel="stylesheet" href="./../assets/style.css">
</head>
<body>
  <header>
    <div class="conteneur">
      <a class="logo" href="./../index.php">
        <img src="./../assets/logo.png" alt="Logo BIT//ARCADE">
        <span>BIT//ARCADE</span>
      </a>
      <nav>
        <a href="./../index.php">Accueil</a>
        <a href="./../jeux/index.php">Jeux</a>
        <?php
        inject_profil_button("./");
        ?>
      </nav>
    </div>
  </header>
  <main>
    <div class="conteneur">
      <form class="formulaire" action="login-action.php" method="post">
        <h1>Connexion.</h1>
        <div class="champ">
          <label for="login">Identifiant</label>
          <input type="text" id="login" name="login" required>
        </div>
        <div class="champ">
          <label for="mdp">Mot de passe</label>
         <input type="password" id="mdp" name="mdp" required>
        </div>
        <button class="bouton" type="submit" style="width:100%">Se connecter</button>
        <p class="bas">Pas de compte ? <a href="inscription.php">Créer un compte</a></p>
      </form>
      <?php
      
      if(isset($_GET['error'])){
        echo "<div class='error'><p class='error_text'>";
        if ($_GET['error']=="wrong_login") {
          // affichage d'un message d'erreur en cas d'identifiant invalide
          echo "Le identifiant fournis ne sont pas valide";
        } elseif ($_GET['error']=="no_request") {
          // affichage d'un message d'erreur en cas de requètes d'authentification invalide
          // -> connection effectué mais requète invalide
          echo "Les champs de nom d'utilisateur et de mot de passe doivent être fournis pour se connecter";
        }elseif ($_GET['error']=="no_role"){
          // Erreur en cas d'acquisition du rôle lors de la connection
          echo "Le rôle n'a pas pu être charger lors la connection, veuillez contacter un administrateur" ;
        }elseif ($_GET['error']=="no_session"){
          // affichage d'un message d'erreur en cas de requètes d'authentification vide
          // -> tentative d'accès à un page pour personne connecté sans connection
          echo "Vous devez être connecté pour accèder à cette page" ;
        } else {
          // erreur générique
          echo "Un erreur lors de la connexion est survenu";
        }
        echo "</p><br><p class='error_code'>Code de l'erreur : '".$_GET['error']."'</p></div>";
      }
      ?>
    </div>
  </main>
  <footer>
    <div class="conteneur">
      <span>BIT//ARCADE</span>
      <span class="page">compte/index.php</span>
    </div>
  </footer>
</body>
</html>
<?php

?>

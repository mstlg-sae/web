<?php
session_start();
include("./../function/php_lib.php");
include("./../function/verify_nobot.php");
profil_page_onlogged("");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Inscription - BIT//ARCADE</title>
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
      <form class="formulaire" action="signup-action.php" method="post">
        <p class="etiquette">Nouveau joueur</p>
        <h1>Inscription.</h1>
        <div class="champ">
          <label for="login">Email (login)</label>
          <input type="text" id="login" name="login" required>
        </div>
        <div class="champ">
          <label for="mdp">Mot de passe</label>
          <input type="password" id="mdp" name="mdp" required>
        </div>
        <div class="champ">
          <label for="mdp_repeat">Confirmer le mot de passe</label>
          <input type="password" id="mdp_repeat" name="mdp_repeat" required>
        </div>
        <div class="champ">
          <label for="secur">Question de securité</label>
          <?php 
              if(isset($_SESSION["nb1"])&& isset($_SESSION["nb2"])){
                echo "Combien fait ".$_SESSION["nb1"]." + ".$_SESSION["nb2"];
              }
          ?>
          <input type="text" id="secur" name="secur" required>
        </div>
        <button class="bouton" type="submit" style="width:100%">Créer mon compte →</button>
        <p class="bas">Déjà un compte ? <a href="index.php">Se connecter</a></p>
      </form>
      <?php
      
      if(isset($_GET['error'])){
        echo "<div class='error'><p class='error_text'>";
        if ($_GET['error']=="password_not_same") {
          // affichage d'un message d'erreur dans le cas si les champs de mot de passe ne corresponde pas
          echo "Les mots de passes choisi ne sont pas les même, réesayé en tapant les même mot de passe.";
        } elseif ($_GET['error']=="no_request") {
          // affichage d'un message d'erreur en cas de requètes d'authentification invalide
          // -> connection effectué mais requète invalide
          echo "Les champs de nom d'utilisateur et de mot de passe doivent être fournis pour s'incrire.";
        }elseif ($_GET['error']=="error_db") {
          // Affichage d'un message en cas d'erreur de la base de données
          echo "Un erreur au niveau de la base de données est survenu.";
        }elseif ($_GET['error']=="no_email") {
          // Affichage d'un message en cas d'email non present dans la requete
          echo "Le login n'est pas un email, donner un email synxtaxiquement valide pour continuer.";
        }elseif ($_GET['error']=="fatal_error_db") {
          // Affichage d'un message en cas d'erreur de la base de données (erreur de role non mis sur la bdd -> connexion impossible)
          echo "Un erreur au niveau de la base de données est survenu. Cette erreur rend impossible la finalisation de la création du compte, veuillez contacter les administrateur.";
        }elseif ($_GET['error']=="login_already_used"){
          // Erreur dans le cas ou le nom d'utilisateur est déjà utilisée
          echo "Ce nom d'utilisateur est déjà utiliser, choissisez - en un autre." ;
        }elseif ($_GET['error']=="weak_password"){
          // affichage d'un message d'erreur en cas de requètes d'authentification vide
          // -> tentative d'accès à un page pour personne connecté sans connection
          echo "Le mot de passe choisi n'est pas assez sécurisé, choissisez en un autre, le mot de passe doit contenir une Majuscule, une minuscule et un nombre" ;
        }elseif ($_GET['error']=="empty_login"){
          // affichage d'un message d'erreur en cas de logins vide
          echo "Le login ne peut pas être vide ou être uniquement composé d'espace" ;
        }elseif ($_GET['error']=="space_in_login"){
          // affichage d'un message d'erreur en cas de logins vide
          echo "L'email n'est pas conforme" ;
        }elseif ($_GET['error']=="bots"){
          // affichage d'un message d'erreur en cas de logins vide
          echo "La question de securité n'est pas valide" ;
        } else {
          // erreur générique
          echo "Un erreur lors de l'inscription est survenu";
        }
        echo "</p><br><p class='error_code'>Code de l'erreur : '".$_GET['error']."'</p></div>";
      }
      ?>
    </div>
  </main>
  <footer>
    <div class="conteneur">
      <span>BIT//ARCADE</span>
      <span class="page">compte\inscription.php</span>
    </div>
  </footer>
</body>
</html>

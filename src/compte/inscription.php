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
          <label for="pseudo">Pseudo</label>
          <input type="text" id="pseudo" name="pseudo">
        </div>
        <div class="champ">
          <label for="mdp">Mot de passe</label>
          <input type="password" id="mdp" name="mdp">
        </div>
        <div class="champ">
          <label for="mdp2">Confirmer le mot de passe</label>
          <input type="password" id="mdp2" name="mdp2">
        </div>
        <button class="bouton" type="submit" style="width:100%">Créer mon compte →</button>
        <p class="bas">Déjà un compte ? <a href="index.php">Se connecter</a></p>
      </form>
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

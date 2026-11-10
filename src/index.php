<?php
session_start();
include("./function/php_lib.php");
?>
<!DOCTYPE html>
<html lang="fr">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>Accueil - BIT//ARCADE</title>
  <link rel="stylesheet" href="./assets/style.css">
</head>
<body>
  <header>
    <div class="conteneur">
      <a class="logo" href="index.php">
        <img src="./assets/logo.png" alt="Logo BIT//ARCADE">
        <span>BIT//ARCADE</span>
      </a>
      <nav>
        <a href="index.php" class="actif">Accueil</a>
        <a href="./jeux/index.php">Jeux</a>
        <?php
        inject_profil_button("./compte/");
        ?>
        
      </nav>
    </div>
  </header>
  <main>
    <section class="blocprincipal">
      <div class="conteneur">
        <p class="etiquette">Bienvenue</p>
        <h1>Parcourt la liste et choissant un<br>Et profite</h1>
        <p>Viens jouez a nos jeux</p>
        <a class="bouton" href="./jeux/index.php">Voir les jeux</a>
      </div>
    </section>
  </main>
  <footer>
    <div class="conteneur">
      <span>BIT//ARCADE</span>
      <span class="page">index.php</span>
    </div>
  </footer>
</body>
</html>

<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Escape Game Vel2</title>
</head>
<body>
    <div class="carte">
        <map name="primary">
            <area shape="rect" coords="244,94,275,254" href="?minigame=1#minigame" alt="Aller à l'énigme du batiment 1 : Garros">
            //bat 2 dd rect
            <area shape="rect" coords="232,253,359,292" href="?minigame=2#minigame" alt="Aller à l'énigme du batiment 2 : Boucher">
            <area shape="rect" coords="282,292,359,387" href="?minigame=2#minigame" alt="Aller à l'énigme du batiment 2 : Boucher">
            //bat 3
            <area shape="rect" coords="360,92,724,285" href="?minigame=3#minigame" alt="Aller à l'énigme du batiment 3 : Bastie">
            //bat4
            <area shape="rect" coords="70,377,220,446" href="?minigame=4#minigame" alt="Aller à l'énigme du batiment 4 : ST EXUPERY">
            //bat5
            <area shape="rect" coords="480,330,621,381" href="?minigame=5#minigame" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            <area shape="rect" coords="533,381,670,430" href="?minigame=5#minigame" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            <area shape="rect" coords="451,364,479,372" href="?minigame=5#minigame" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            //CERCLE 414 434 60 (bat6)
            <area shape="circle" coords="414,434,60" href="?minigame=6#minigame" alt="Aller à l'énigme du batiment 6 : BLERIOT">
            //BAT 7
            <area shape="rect" coords="535,472,700,522" href="?minigame=7#minigame" alt="Aller à l'énigme du batiment 7 : Ancien loge du gardien">
            //bat 8
            <area shape="rect" coords="238,461,333,492" href="?minigame=8#minigame" alt="Aller à l'énigme du batiment 8 : Batiment modulaire (BDE)">

            
        </map>
        <img src="./assets/map.png" usemap="#primary" alt="Plan de l'iut de velizy">*
    </div>
    <?php
    // Récupération de la minigame depuis les paramètres de l'URL
    if (isset($_GET['minigame'])) {
        $minigame = intval(htmlspecialchars($_GET["minigame"]));
        echo "<div class='defi' id='minigame'>";
        echo "<h1>Défi n°" .$minigame. "</h1>";
        // Ajoutez ici le contenu de votre minigame
        echo "<p>Contenu de la minigame " . $minigame . "...</p>";
        echo "<iframe src='./minigame/BAT".$minigame.".php' title='Enigme numéro ".$minigame."' class='iframe_minigame'></iframe>";
        echo "</div>";
    } else {
        echo "<h1>Sélectionner un bâtiment pour lancer un mini jeu</h1>";
    }
    ?>
</body>

</html>
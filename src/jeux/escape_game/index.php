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
            <area shape="rect" coords="244,94,275,254" href="#minigame?minigame=1" alt="Aller à l'énigme du batiment 1 : Garros">
            //bat 2 dd rect
            <area shape="rect" coords="232,253,359,292" href="#minigame?minigame=2" alt="Aller à l'énigme du batiment 2 : Boucher">
            <area shape="rect" coords="282,292,359,387" href="#minigame?minigame=2" alt="Aller à l'énigme du batiment 2 : Boucher">
            //bat 3
            <area shape="rect" coords="360,92,724,285" href="#minigame?minigame=3" alt="Aller à l'énigme du batiment 3 : Bastie">
            //bat4
            <area shape="rect" coords="70,377,220,446" href="#minigame?minigame=4" alt="Aller à l'énigme du batiment 4 : ST EXUPERY">
            //bat5
            <area shape="rect" coords="480,330,621,381" href="#minigame?minigame=5" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            <area shape="rect" coords="533,381,670,430" href="#minigame?minigame=5" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            <area shape="rect" coords="451,364,479,372" href="#minigame?minigame=5" alt="Aller à l'énigme du batiment 5 : MERMOZ">
            //CERCLE 414 434 60 (bat6)
            <area shape="circle" coords="414,434,60" href="#minigame?minigame=6" alt="Aller à l'énigme du batiment 6 : BLERIOT">
            //BAT 7
            <area shape="rect" coords="535,472,700,522" href="#minigame?minigame=7" alt="Aller à l'énigme du batiment 7 : Ancien loge du gardien">
            //bat 8
            <area shape="rect" coords="238,461,333,492" href="#minigame?minigame=8" alt="Aller à l'énigme du batiment 8 : Batiment modulaire (BDE)">

            
        </map>
        <img src="./assets/map.png" usemap="#primary" alt="Plan de l'iut de velizy">*
    </div>
    <div class="defi" id="minigame">
        <h1>Défi N°%PHP_MINIGAME%</h1>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Illum voluptates est sequi animi quos nam enim ullam ad ea libero culpa facere cumque asperiores, non necessitatibus! Minus mollitia totam animi?</p>
    </div>
</body>

</html>
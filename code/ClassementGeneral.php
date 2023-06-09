<!DOCTYPE html>
<?php
  session_start();
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
    
    //var_dump($_SESSION['utilisateur']);
    $isLoggedIn = isset($_SESSION['utilisateur']);
    $idUser = $isLoggedIn ? (int)$_SESSION['utilisateur']['id_utilisateur'] : null;
    //var_dump($isLoggedIn);
?>


<html>

<head>
    <meta charset="UTF-8">
    <title>Classement g&eacuten&eacuteral</title>
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
    <!--bootstrap : biblio  qui permet l'adaptation du interface à différents écran avec ordi tablette telephone va amener à javascript(animation, ....)-->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.7/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.3.1/dist/js/bootstrap.min.js"></script>

    <style>
    th,
    td {
        padding: 10px;
        width: 150px;
    }

    nav {
        background-color: #a80000;
        overflow: hidden;
        padding-bottom: 16px;
    }

    nav a {
        float: left;
        color: white;
        text-align: center;
        padding: 14px 16px;
        text-decoration: none;
    }

    nav a:hover {
        background-color: #ddd;
        color: black;
    }

    nav a.active {
        background-color: #f66900;
        color: white;
    }

    nav a.not {
        background-color: #a80000;
    }

    #menu svg {
        cursor: pointer;
        /* changer le curseur de la souris pour indiquer que l'élément est cliquable */
    }

    #menu:hover ul,
    #menu svg:focus+ul {
        display: block;
        /* afficher la liste de liens lorsqu'on survole le menu ou lorsqu'on clique sur le SVG */
    }

    .container {
        text-align: center;
    }

    button {
        margin: 0 auto;
        background-color: black;
        border: black;
        border-radius: 15px;
        color: white;
        padding: 10px;
        text-align: center;
        text-decoration: none;
        display: inline-block;
        font-size: 15px;
        cursor: pointer;

    }

    .form-group {
        display: flex;
        flex-direction: row;
        margin-bottom: 10px;
    }

    .form-group label {
        width: 100px;
    }

    .form-group input {
        flex: 1;
    }

    li {
        list-style: none;
        margin: 5px 0;
    }

    li button {
        display: inline-block;
        background-color: #000000;
        color: #fff;
        border: none;
        border-radius: 50%;
        padding: 3px 8px;
        font-size: 1rem;
        cursor: pointer;
        box-shadow: 2px 2px 5px rgba(0, 0, 0, 0.3);
    }

    li p {
        display: inline-block;
        margin: 0;
        padding-left: 10px;
    }

    li button:hover {
        background-color: #ff6961;
    }


    .partie-header {
        position: relative;
    }

    .partie-header .icon-container {
        position: absolute;
        top: 0;
        right: 0;
        padding: 5px;
    }

    .partie-header .icon-container svg {
        width: 35px;
        height: 35px;
        fill: black;
        /* Couleur de remplissage de l'icône */
    }


    .partie-classement {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .collapsed {
        max-height: 0;
    }



    .partie {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        margin: 10px;
        padding: 20px;
    }

    .partie-header {
        font-weight: bold;
        font-size: 18px;
        margin-bottom: 10px;
    }

    .partie-body {
        margin-left: 20px;
    }

    .partie-classement {
        margin-top: 20px;
        margin-bottom: 5px;
        margin-left: 30px;
    }

    .partie-entite {
        margin-bottom: 5px;
    }


    .container {
        width: 100%;
        margin-top: 10px;
        padding: 0px;
    }

    .tab {
        overflow: hidden;
        border-bottom: 1px solid #ccc;
        background-color: #f66900;
        display: flex;
        width: 100%;
        justify-content: space-between;
        /* Ajout de l'espacement entre les onglets */
    }

    .tab button {
        background-color: inherit;
        flex: 1;
        border: none;
        outline: none;
        cursor: pointer;
        padding: 14px 16px;
        transition: background-color 0.3s;
        border-radius: 0px;
    }

    .tab button:hover {
        background-color: #a80000;
        border-radius: 0px;
    }

    .tab button.active {
        background-color: #a80000;
        border-radius: 0px;
    }

    .tabcontent {
        display: none;
        padding: 20px;
        border-top: 1px solid #ccc;
        width: 100%;
    }
    </style>


    <script>
    function AffichageDetails(element) {
        // Sur les différences
        var partie = element.closest('.partie');
        var partieClassement = partie.querySelector('.partie-classement');
        partieClassement.classList.toggle("collapsed");
        if (partieClassement.classList.contains("collapsed")) {
            partieClassement.style.maxHeight = null;
        } else {
            partieClassement.style.maxHeight = partieClassement.scrollHeight + "px";
        }

        // Sur le header
        var partieHeader = element.querySelector('.partie-header');
        var iconOuverture = partieHeader.querySelector('#icon-ouverture');
        // Vérifier la classe active de la partie-header
        var isActive = partieHeader.classList.contains("active");
        // Changer le contenu de la balise SVG en fonction de la classe active
        if (isActive) {
            iconOuverture.innerHTML =
                "<path d='M0 0h24v24H0z' fill='none'/><path d='M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z'/>";
        } else {
            iconOuverture.innerHTML =
                "<path d='M0 0h24v24H0z' fill='none'/><path d='M12 8l-6 6 1.41 1.41L12 10.83l4.59 4.58L18 14z'/>";
        }
        partieHeader.classList.toggle("active");
    }

    // Fonction pour afficher le contenu de l'onglet sélectionné et masquer les autres
    function openTab(evt, tabName) {
        var i, tabcontent, tablinks;
        tabcontent = document.getElementsByClassName("tabcontent");
        for (i = 0; i < tabcontent.length; i++) {
            tabcontent[i].style.display = "none";
        }
        tablinks = document.getElementsByClassName("tablink");
        for (i = 0; i < tablinks.length; i++) {
            tablinks[i].className = tablinks[i].className.replace(" active", "");
        }
        document.getElementById(tabName).style.display = "block";
        evt.currentTarget.className += " active";
    }
    </script>

</head>

<body>

    <header>
        <!-- Le menu -->
        <nav id="menu">
            <label for="menu-toggle">
            </label>
            <ul>
                <a class="not"> <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                    </svg></a>
                <a class="a-menu" href="index.php">Accueil</a>
                <a class="a-menu" href="CreerPartie.php">Creer une partie</a>
                <a class="a-menu" href="Jouer.php">Jouer</a>
                <a class="active a-menu" href="ClassementGeneral.php">Classement</a>
                <a class="a-menu" href="SesPartie.php">Mes parties</a>
                <a class="a-menu" href="Compte.php">Compte</a>
                <a href="mailto:gabrielle-pointeau.jeuxdedifferences@hotmail.com?subject=Demande de Contact">Contact</a>
                <?php if ($isLoggedIn)  {?><a href="logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                    </svg>
                </a><?php }?>
            </ul>
        </nav>
    </header>

    <div class="container">
        <!-- Barre d'onglets des parties à afficher -->
        <div class="tab">
            <button class="tablink active" onclick="openTab(event, 'general')"><strong>CLASSEMENT
                    GENERAL</strong></button>
            <button class="tablink" onclick="openTab(event, 'partie_creer')"><strong>CLASSEMENT DE MES
                    PARTIES</strong></button>
            <button class="tablink" onclick="openTab(event, 'partie_jouer')"><strong>CLASSEMENT DES PARTIES
                    JOU&EacuteES</strong></button>
        </div>
    </div>


    <header class="row">
        <h1 class="col-sm-12 text-center align-self-center">
            <strong>
                <FONT face="Times New Roman">
                    <br />Classement g&eacuten&eacuteral ! <br />

                    <img src="./images/medaille.jpg">

            </strong>
            </FONT>
        </h1>
    </header>





    <?php
    

    // Récupération des données de classement général
    $query = "SELECT id_utilisateur, nom, prenom, score_utilisateur FROM utilisateur ORDER BY score_utilisateur DESC";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $classement_general = $stmt->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($classement_general);

    // Affichage des données de classement dans un tableau pour le classement général
    echo '<div id="general" class="tabcontent general">';
        echo '<table style="margin: auto;">';
            echo "<tr>
                <th>Position</th>
                <th>Nom</th>
                <th>Prenom</th>
                <th>Score</th>
            </tr>";
            $position = 1;
            foreach ($classement_general as $joueur) {
                $style = "";
                if ($joueur['id_utilisateur'] == $idUser) {
                    $style = "background-color: orange;";
                }
                echo "<tr style='{$style}'>
                    <td>{$position}</td>
                    <td>{$joueur['nom']}</td>
                    <td>{$joueur['prenom']}</td>
                    <td>{$joueur['score_utilisateur']}</td>
                </tr>";
                $position++;
            }
        echo "</table>";
    echo "</div>";
    
    
    // Classement pour mes parties
    $sqlPartie = "SELECT * FROM parties WHERE idUtilisateur = :id";
    $sthPartie = $dbh-> prepare($sqlPartie);
    $sthPartie->bindParam(':id', $idUser);
    $sthPartie -> execute();
    $parties = $sthPartie->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($parties as $p){
        var_dump($p['id_parties'], "<br><br>");
    }*/
    
    $classements_creer = array();
    
    // Recherche du classment
    foreach ($parties as $p){
        // Récupération des données de classement des parties créées
        $query = "SELECT * FROM partie_jouer, utilisateur WHERE idUtilisateur = id_utilisateur AND idPartie = :idP ORDER BY score DESC;";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':idP', $p['id_parties']);
        $stmt->execute();
        $classement_creer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($classement_creer) != 0){
            $classements_creer[] = $classement_creer;
        }
        else{
            $classements_creer[] = array();
        }
        
    }
    /*foreach ($classements_creer as $c){
        var_dump($c, "<br><br>");
    }*/
    
    
    // Recherche des entités pour chaque parties
    $sqlEntite = "SELECT id_entite, nom_entite FROM entites, parties WHERE idUtilisateur = :id AND (idEntite1 = id_entite OR idEntite2 = id_entite)";
    $sthEntite = $dbh-> prepare($sqlEntite);
    $sthEntite->bindParam(':id', $idUser);
    $sthEntite -> execute();
    $entites = $sthEntite->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($entites);
    
    /*// Selection des différences (par joueurs)
    $sqlDiff = "SELECT idPartie, id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference;";
    $sthDiff = $dbh->prepare($sqlDiff);
    $sthDiff->bindParam(':idUser', $idUser);
    $sthDiff->execute();
    $differences = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($differences as $i => $difference) {
        var_dump($difference, "<br>");
    }*/
    
    
    if (count($parties) === 0){
        echo "<p> Vous n'avez pas encore de parties à vous </p>";
    }
    
    // Mettre les entités par deux
    $entite_parDeux = array();
    // Vérifier s'il y a un nombre pair d'éléments dans le tableau
    if (count($entites) % 2 === 0) {
        // Parcourir les indices du tableau avec un pas de 2
        for ($i = 0; $i < count($entites); $i += 2) {
            $entite1 = $entites[$i];
            $entite2 = $entites[$i + 1];
            
            // Créer une paire d'entités et l'ajouter dans le nouveau tableau
            $paire = array($entite1, $entite2);
            $entite_parDeux[] = $paire;
        }
    } else {
        echo "Le tableau doit avoir un nombre pair d'éléments pour grouper les entités deux par deux.";
    }
    
    /*// Mettre les différences par deux
    $differences_parDeux = array();
    // Vérifier s'il y a un nombre pair d'éléments dans le tableau
    if (count($differences) % 2 === 0) {
        // Parcourir les indices du tableau avec un pas de 2
        for ($i = 0; $i < count($differences); $i += 2) {
            $difference1 = $differences[$i];
            $difference2 = $differences[$i + 1];
            
            // Créer une paire de différence et l'ajouter dans le nouveau tableau
            $paire = array($difference1, $difference2);
            $differences_parDeux[] = $paire;
        }
    } else {
        echo "Le tableau doit avoir un nombre pair d'éléments pour grouper les entités deux par deux.";
    }
    //var_dump($differences_parDeux);*/
    
?>

    <div id="partie_creer" class="tabcontent partie_creer">
        <?php 
        foreach ($parties as $i => $partie) {
            
            $k = 0;
            echo "<div class='partie' onclick='AffichageDetails(this)'>";
                echo "<div class='partie-header'>Partie n°". ($i + 1);
                    echo "<span class='icon-container'>";
                        echo "<svg id='icon-ouverture' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#000000'>
                                <path d='M0 0h24v24H0z' fill='none'/><path d='M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z'/>
                            </svg>";
                    echo "</span>";
                echo "</div>";
                echo "<div class='partie-body'>";
                 
                    foreach ($entite_parDeux as $e) {
                        if ($e[0]['id_entite'] == $partie['idEntite1']){
                            echo "<div class='partie-entite'>";
                                echo "<strong>Entit&eacute n°1 : </strong>".$e[0]['nom_entite'];
                                echo "<br>";
                                echo "<strong>Entit&eacute n°2 : </strong>".$e[1]['nom_entite'];
                            echo "</div>";
                            
                            // Affichage des données de classement dans un tableau
                            echo '<div class="partie-classement collapsed">';
                                echo '<table style="margin: auto;">';
                                    echo "<tr>
                                        <th>Position</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Score</th>
                                    </tr>";
                                    $position = 1;
                                    // Si le classement est vide
                                    //var_dump("<br><br>", $classements_creer[$i]);
                                    if ($classements_creer[$i][0]['idPartie'] != $partie['id_parties']){
                                        echo "<p style='color:red;'>Personne n'a jouer encore à cette partie</p>";
                                    }
                                    else{
                                        // Parcours des joueurs de chaque partie
                                        foreach ($classements_creer[$i] as $c){
                                            //var_dump($classements_creer[$i], "<br>", $c['idPartie'], "<br>", $partie['id_parties']);
                                        
                                            $style = "";
                                            echo "<tr style='{$style}'>
                                                <td>{$position}</td>
                                                <td>{$c['nom']}</td>
                                                <td>{$c['prenom']}</td>
                                                <td>{$c['score']}</td>
                                            </tr>";
                                            $position++;
                                            
                                        }
                                    
                                    }
                                echo "</table>";
                            echo "</div>";
                        }
                    }
                echo "</div>";
            echo "</div>";
        } ?>
    </div>





    <?php
    // Recherche des parties joué pour chercher les utilisateurs
    $sqlPartie = "SELECT id_parties, pj.idUtilisateur AS idUse_Joueur, p.idUtilisateur AS idUse_Createur, score, pourcentage, nb_fois_jouer, idEntite1, idEntite2 FROM partie_jouer AS pj, parties AS p WHERE idPartie = id_parties AND pj.idUtilisateur = :id; ";
    $sthPartie = $dbh-> prepare($sqlPartie);
    $sthPartie->bindParam(':id', $idUser);
    $sthPartie -> execute();
    $parties = $sthPartie->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($parties);
    
    // Recherche des joueurs qui ont aussi joué à la partie
    
    
    $classements_jouer = array();
    
    // Recherche du classment
    foreach ($parties as $p){
        // Récupération des données de classement des parties jouées
        $query = "SELECT * FROM partie_jouer, utilisateur WHERE idUtilisateur = id_utilisateur AND idPartie = :idP ORDER BY score DESC;";
        $stmt = $dbh->prepare($query);
        $stmt->bindParam(':idP', $p['id_parties']);
        $stmt->execute();
        $classement_jouer = $stmt->fetchAll(PDO::FETCH_ASSOC);
        if (count($classement_jouer) != 0){
            $classements_jouer[] = $classement_jouer;
        }
        else{
            $classements_jouer[] = array();
        }
        
    }
    /*foreach ($classements_jouer as $c){
        var_dump($c, "<br><br>");
    }*/
    
    // Entites et mettre en pair
    $entite_parDeux = array();
    $createurs = array();
    for ($i = 0; $i < count($parties); $i += 1){
        //var_dump($parties[$i]['idEntite1'], $parties[$i]['idEntite2'], "<br>");
        $sqlEntite = "SELECT id_entite, nom_entite FROM entites WHERE id_entite = :idE1 OR id_entite = :idE2;";
        //var_dump($sqlEntite, "<br>");
        $sthEntite = $dbh-> prepare($sqlEntite);
        $sthEntite->bindParam(':idE1', $parties[$i]['idEntite1']);
        $sthEntite->bindParam(':idE2', $parties[$i]['idEntite2']);
        $sthEntite -> execute();
        $entites = $sthEntite->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($entites, "<br>");
    
        $entite1 = $entites[0];
        $entite2 = $entites[1];
        
        // Créer une paire d'entités et l'ajouter dans le nouveau tableau
        $paire = array($entite1, $entite2);
        $entite_parDeux[] = $paire;
        
        
        // Selection de l'utilisateur creant la partie
        $sqlUse = "SELECT id_utilisateur, nom, prenom FROM utilisateur WHERE id_utilisateur = :idUser;";
        $sthUse = $dbh->prepare($sqlUse);
        $sthUse->bindParam(':idUser', $parties[$i]['idUse_Createur']);
        $sthUse->execute();
        $use = $sthUse->fetchAll(PDO::FETCH_ASSOC);
        //var_dump($use);
        $createurs[] = $use[0]["nom"]." ".$use[0]["prenom"];
    }
    //var_dump($entite_parDeux);
    //var_dump($createurs);
    
    /*// Selection des différences
    $sqlDiff = "SELECT idUtilisateur, idPartie, id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference;";
    $sthDiff = $dbh->prepare($sqlDiff);
    $sthDiff->bindParam(':idUser', $idUser);
    $sthDiff->execute();
    $differences = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($differences as $i => $difference) {
        var_dump($difference, "<br>");
    }*/
    
    
    /*// Mettre les différences par deux
    $differences_parDeux = array();
    // Vérifier s'il y a un nombre pair d'éléments dans le tableau
    if (count($differences) % 2 === 0) {
        // Parcourir les indices du tableau avec un pas de 2
        for ($i = 0; $i < count($differences); $i += 2) {
            $difference1 = $differences[$i];
            $difference2 = $differences[$i + 1];
            
            // Créer une paire de différence et l'ajouter dans le nouveau tableau
            $paire = array($difference1, $difference2);
            $differences_parDeux[] = $paire;
        }
    } else {
        echo "Le tableau doit avoir un nombre pair d'éléments pour grouper les entités deux par deux.";
    }
    //var_dump($differences_parDeux);*/
    
    
    
    
?>


    <div id="partie_jouer" class="tabcontent partie_jouer">
        <?php 
        foreach ($parties as $i => $partie) {
            
            $k = 0;
            echo "<div class='partie' onclick='AffichageDetails(this)'>";
                echo "<div class='partie-header'>Partie n°". ($i + 1);
                    echo "<span class='icon-container'>";
                        echo "<svg id='icon-ouverture' xmlns='http://www.w3.org/2000/svg' height='24px' viewBox='0 0 24 24' width='24px' fill='#000000'>
                                <path d='M0 0h24v24H0z' fill='none'/><path d='M16.59 8.59L12 13.17 7.41 8.59 6 10l6 6 6-6z'/>
                            </svg>";
                    echo "</span>";
                echo "</div>";
                echo "<div class='partie-body'>";
                 
                    foreach ($entite_parDeux as $e) {
                        if ($e[0]['id_entite'] == $partie['idEntite1']){
                            echo "<div class='partie-entite'>";
                                echo "<strong>Entit&eacute n°1 : </strong>".$e[0]['nom_entite'];
                                echo "<br>";
                                echo "<strong>Entit&eacute n°2 : </strong>".$e[1]['nom_entite'];
                            echo "</div>";
                            
                            // Affichage des données de classement dans un tableau
                            echo '<div class="partie-classement collapsed">';
                                echo '<table style="margin: auto;">';
                                    echo "<tr>
                                        <th>Position</th>
                                        <th>Nom</th>
                                        <th>Prenom</th>
                                        <th>Score</th>
                                    </tr>";
                                    $position = 1;
                                    // Si le classement est vide
                                    //var_dump("<br><br>", $classements_jouer[$i]);
                                    if ($classements_jouer[$i][0]['idPartie'] != $partie['id_parties']){
                                        echo "<p style='color:red;'>Personne n'a jouer encore à cette partie</p>";
                                    }
                                    else{
                                        // Parcours des joueurs de chaque partie
                                        foreach ($classements_jouer[$i] as $c){
                                            //var_dump($classements_jouer[$i], "<br>", $c['idPartie'], "<br>", $partie['id_parties']);
                                        
                                            $style = "";
                                            if ($c['id_utilisateur'] == $idUser) {
                                                $style = "background-color: orange;";
                                            }
                                            echo "<tr style='{$style}'>
                                                <td>{$position}</td>
                                                <td>{$c['nom']}</td>
                                                <td>{$c['prenom']}</td>
                                                <td>{$c['score']}</td>
                                            </tr>";
                                            $position++;
                                            
                                        }
                                    
                                    }
                                echo "</table>";
                            echo "</div>";
                        }
                    }
                echo "</div>";
            echo "</div>";
        } ?>
    </div>

    <br><br>

    <script>
    // Par défaut, afficher le premier onglet au chargement de la page (partie1)
    document.getElementById("general").style.display = "block";
    document.getElementById("general").className = "tabcontent general";
    </script>


</body>

<footer>

</footer>

</html>
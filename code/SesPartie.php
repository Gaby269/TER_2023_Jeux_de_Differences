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
    //var_dump($isLoggedIn);
    $id_user = $_SESSION['utilisateur']['id_utilisateur'];
?>


<head>
    <link rel="stylesheet" href="CSS/style.css" />

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
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

    .partie-difference {
        margin-top: 20px;
        margin-bottom: 5px;
        margin-left: 30px;
    }

    .partie-entite {
        margin-bottom: 5px;
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


    table {
        border-collapse: collapse;
    }

    th,
    td {
        border: 2px solid #ccc;
        padding: 8px;
        text-align: center;
    }

    .no-border {
        border-left: none;
        border-right: none;
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


    .partie-difference {
        max-height: 0;
        overflow: hidden;
        transition: max-height 0.3s ease-in-out;
    }

    .collapsed {
        max-height: 0;
    }


    .score {
        grid-row: 1 / -1;
    }
    </style>

    <script>
    function AffichageDetails(element) {
        // Sur les différences
        var partie = element.closest('.partie');
        var partieDifference = partie.querySelector('.partie-difference');
        partieDifference.classList.toggle("collapsed");
        if (partieDifference.classList.contains("collapsed")) {
            partieDifference.style.maxHeight = null;
        } else {
            partieDifference.style.maxHeight = partieDifference.scrollHeight + "px";
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
                <a class="a-menu" href="ClassementGeneral.php">Classement</a>
                <a class="active a-menu" href="SesPartie.php">Mes parties</a>
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
            <button class="tablink active" onclick="openTab(event, 'partie1')"><strong>PARTIES
                    CR&EacuteES</strong></button>
            <button class="tablink" onclick="openTab(event, 'partie2')"><strong>PARTIES JOU&EacuteES</strong></button>
        </div>
    </div>



    <?php
    $sqlPartie = "SELECT * FROM parties WHERE idUtilisateur = :id";
    $sthPartie = $dbh-> prepare($sqlPartie);
    $sthPartie->bindParam(':id', $id_user);
    $sthPartie -> execute();
    $parties = $sthPartie->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($parties);
    
    $sqlEntite = "SELECT id_entite, nom_entite FROM entites, parties WHERE idUtilisateur = :id AND (idEntite1 = id_entite OR idEntite2 = id_entite)";
    $sthEntite = $dbh-> prepare($sqlEntite);
    $sthEntite->bindParam(':id', $id_user);
    $sthEntite -> execute();
    $entites = $sthEntite->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($entites);
    
    // Selection des différences
    $sqlDiff = "SELECT idPartie, id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference;";
    $sthDiff = $dbh->prepare($sqlDiff);
    $sthDiff->bindParam(':idUser', $id_user);
    $sthDiff->execute();
    $differences = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($differences as $i => $difference) {
        var_dump($difference, "<br>");
    }*/
    
    
    if ($parties === false){
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
    
    // Mettre les différences par deux
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
    //var_dump($differences_parDeux);
    
?>

    <div id="partie1" class="tabcontent parties_creer">
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
                            
                        echo "<div class='partie-difference collapsed'> ";
                            echo "<table>"; // Début de la table pour chaque partie
                                echo "<tr>";
                                    echo "<th colspan='2'>";
                                        echo "Entit&eacute n°1";
                                    echo "</th>";
                                    echo "<th colspan='2'>";
                                        echo "Entit&eacute n°2";
                                    echo "</th>";
                                echo "</tr>";
                                echo "<tr>";
                                    echo "<td colspan='2' style='align-text:center;'>";
                                        echo $e[0]['nom_entite'];
                                    echo "</th>";
                                    echo "<td colspan='2'>";
                                        echo $e[1]['nom_entite'];
                                    echo "</th>";
                                echo "</tr>";
                            break;
                        }
                    }
                                echo "<tr>";
                                    echo "<td>";
                                        echo "<strong>Type</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<strong>Valeur</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<strong>Type</strong>";
                                    echo "</td>";
                                    echo "<td>";
                                        echo "<strong>Valeur</strong>";
                                    echo "</td>";
                                echo "<tr>";            
                    foreach ($differences_parDeux as $d) {
                        if ($d[0]['idPartie'] == $partie['id_parties']){
                                echo "<tr>";
                                    echo "<td>";
                                        echo $d[0]['type_diff'];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $d[0]['valeur_diff'];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $d[1]['type_diff'];
                                    echo "</td>";
                                    echo "<td>";
                                        echo $d[1]['valeur_diff'];
                                    echo "</td>";
                                echo "<tr>";
                            $k = $k + 1;
                        }
                    }
                            echo "</table>"; // Fin de la table pour chaque partie
                    
                        echo "</div>";
                echo "</div>";
            echo "</div>";
        } ?>
    </div>


    <?php
    $sqlPartie = "SELECT id_parties, pj.idUtilisateur AS idUse_Joueur, p.idUtilisateur AS idUse_Createur, score, pourcentage, nb_fois_jouer, idEntite1, idEntite2 FROM partie_jouer AS pj, parties AS p WHERE idPartie = id_parties AND pj.idUtilisateur = :id; ";
    $sthPartie = $dbh-> prepare($sqlPartie);
    $sthPartie->bindParam(':id', $id_user);
    $sthPartie -> execute();
    $parties = $sthPartie->fetchAll(PDO::FETCH_ASSOC);
    //var_dump($parties);
    
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
    
    // Selection des différences
    $sqlDiff = "SELECT idUtilisateur, idPartie, id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference;";
    $sthDiff = $dbh->prepare($sqlDiff);
    $sthDiff->bindParam(':idUser', $id_user);
    $sthDiff->execute();
    $differences = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
    /*foreach ($differences as $i => $difference) {
        var_dump($difference, "<br>");
    }*/
    
    
    // Mettre les différences par deux
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
    //var_dump($differences_parDeux);
    
    
    
    
?>


    <div id="partie2" class="tabcontent">
        <?php 
        foreach ($parties as $j => $partie) {
            $k = 0;
            echo "<div class='partie' onclick='AffichageDetails(this)'>";
                echo "<div class='partie-header'>Partie de ".$createurs[$j];
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
                            
                        echo "<div class='partie-difference collapsed'> ";
                            echo "<div style='display: flex;'>";
                                echo "<table style='border: 2px solid #ccc; margin-right: 10px;'>"; // Début de la table pour chaque partie
                                    echo "<tr>";
                                        echo "<th colspan='2'>";
                                            echo "Entit&eacute n°1";
                                        echo "</th>";
                                        echo "<th colspan='2'>";
                                            echo "Entit&eacute n°2";
                                        echo "</th>";
                                    echo "</tr>";
                                    echo "<tr>";
                                        echo "<td colspan='2' style='align-text:center;'>";
                                            echo $e[0]['nom_entite'];
                                        echo "</td>";
                                        echo "<td colspan='2'>";
                                            echo $e[1]['nom_entite'];
                                        echo "</td>";
                                    echo "</tr>";
                            break;
                        }
                    }
                                    echo "<tr>";
                                        echo "<td>";
                                            echo "<strong>Type</strong>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<strong>Valeur</strong>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<strong>Type</strong>";
                                        echo "</td>";
                                        echo "<td>";
                                            echo "<strong>Valeur</strong>";
                                        echo "</td>";
                                    echo "<tr>";            
                    foreach ($differences_parDeux as $d) {
                        if ($d[0]['idPartie'] == $partie['id_parties']){
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $d[0]['type_diff'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $d[0]['valeur_diff'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $d[1]['type_diff'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $d[1]['valeur_diff'];
                                        echo "</td>";
                                    echo "<tr>";
                            $k = $k + 1;
                        }
                    }
                                echo "</table>"; // Fin de la table pour chaque partie
                                echo "<table style='border: 2px solid #ccc; margin-left: 10px;'>";
                                    echo "<tr>";
                                        echo "<th>";
                                            echo "Score";
                                        echo "</th>";
                                        echo "<th>";
                                            echo "Pourcentage";
                                        echo "</th>";
                                        echo "<th>";
                                            echo "Nombre de fois";
                                        echo "</th>";
                                    echo "</tr>";
                                
                                    echo "<tr>";
                                        echo "<td>";
                                            echo $partie['score'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $partie['pourcentage'];
                                        echo "</td>";
                                        echo "<td>";
                                            echo $partie['nb_fois_jouer'];
                                        echo "</td>";
                                        
                                    echo "</tr>";
                                echo "</table>";
                            echo "</div>";
                                
                        echo "</div>";
                echo "</div>";
            echo "</div>";
        } ?>
    </div>

    <script>
    // Par défaut, afficher le premier onglet au chargement de la page (partie1)
    document.getElementById("partie1").style.display = "block";
    document.getElementById("partie1").className = "tabcontent parties_creer";
    </script>
</body>
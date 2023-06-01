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
    
    var_dump($_SESSION['utilisateur']);
    $isLoggedIn = isset($_SESSION['utilisateur']);
    var_dump($isLoggedIn);
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
    .partie {
        background-color: #fff;
        border-radius: 5px;
        box-shadow: 0px 2px 4px rgba(0, 0, 0, 0.2);
        margin: 10px;
        padding: 10px;
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
        margin-bottom: 5px;
    }

    .partie-entite {
        margin-bottom: 8px;
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
    </style>
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



    <?php
    $sqlPartie = "SELECT * FROM parties WHERE idUtilisateur = :id";
    $sthPartie = $dbh-> prepare($sqlPartie);
    $sthPartie->bindParam(':id', $id_user);
    $sthPartie -> execute();
    $parties = $sthPartie->fetchAll(PDO::FETCH_ASSOC);
    
    $sqlEntite = "SELECT id_entite, nom_entite FROM entites, parties WHERE idUtilisateur = :id AND (idEntite1 = id_entite OR idEntite2 = id_entite)";
    $sthEntite = $dbh-> prepare($sqlEntite);
    $sthEntite->bindParam(':id', $id_user);
    $sthEntite -> execute();
    $entites = $sthEntite->fetchAll(PDO::FETCH_ASSOC);
    
    
    if ($parties === false){
        echo "<p> Vous n'avez pas encore de parties à vous </p>";
    }
    
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
    
    


?>

    <div class="parties">
        <?php foreach ($parties as $i => $partie) { ?>
        <div class="partie">
            <div class="partie-header"><?php echo "Partie n°".$i+1; ?></div>
            <div class="partie-body">
                <?php foreach ($entite_parDeux as $e) { 
                if ($e[0]['id_entite'] == $partie['idEntite1']){?>
                <div class="partie-difference">
                    <?php echo "<strong>Entit&eacute n°1 : </strong>".$e[0]['nom_entite'] . "<br><strong>Entit&eacute n°2 : </strong>".$e[1]['nom_entite'];?>
                </div>
                <?php break;}} ?>
            </div>
        </div>
        <?php } ?>
    </div>

</body>
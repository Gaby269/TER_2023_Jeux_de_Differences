<!doctype html>
<?php 
    session_start();
    if (isset($_SESSION['partieCouranteCree'])){
        unset($_SESSION['partieCouranteCree']);
    }
    if (isset($_SESSION['partieCouranteJoue'])){
        unset($_SESSION['partieCouranteJoue']);
    }
    
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
    
    if (isset($_SESSION['utilisateur'])){
        //selection de l'identificateur du mail de la personne qui vient de sinscrire
        $use = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$_SESSION['utilisateur']['id_utilisateur']."';";
        //execution
        $sth = $dbh->query($use);
        if (!$sth) die("Impossible d'éxécuter la requête !");
        $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = $utilisateur;
    }
    //var_dump(isset($_SESSION['utilisateur']));
    //var_dump($_SESSION['utilisateur']);
        
    
    //var_dump(isset($_SESSION['utilisateur']));
    $isLoggedIn = isset($_SESSION['utilisateur']);
    //var_dump($isLoggedIn);
    
?>

<html lang="fr">

<head>

    <meta charset="utf-8" />
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="icon" href="images/logo.png" type="image/x-icon">
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

    <!--bcq de lien style graphique, sous biblio de js, ... pour utiliser bootstrapcdn on copie colle les liens avnt-->

    <title> Menu </title>

    <style>
    /* Media query pour les écrans de taille inférieure à 600 pixels */
    @media screen and (max-width: 600px) {
        .partie {
            /* Styles pour les écrans étroits (téléphones) */
        }
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

    body {
        margin: 0;
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

    #bandeau {
        margin-top: 5px;
        /* ou une valeur appropriée */


    }

    #contenu a {
        font-size: 20px;
    }

    .agrandir {
        width: 200px;
        height: 50px;
    }

    .bandeau-custom {
        margin-top: 10px;
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
                <a class="not a-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </a>
                <a class="active a-menu" href="index.php">Accueil</a>
                <a class="a-menu"
                    <?php if ($isLoggedIn)  { echo 'href="CreerPartie.php"'; } else{ echo 'href="connexion.php?site=Partie"'; }?>>Creer
                    une partie</a>
                <a class="a-menu"
                    <?php if ($isLoggedIn)  { echo 'href="Jouer.php"'; } else{ echo 'href="connexion.php?site=Jouer"'; }?>>Jouer</a>
                <a class="a-menu"
                    <?php if ($isLoggedIn)  { echo 'href="ClassementGeneral.php"'; } else{ echo 'href="connexion.php?site=Classement"';}?>>Classement</a>
                <a class="a-menu"
                    <?php if ($isLoggedIn)  { echo 'href="SesPartie.php"'; } else{ echo 'href="connexion.php?site=MesParties"';}?>>Mes
                    Parties</a>
                <a class="a-menu"
                    <?php if ($isLoggedIn)  { echo 'href="Compte.php"'; } else{ echo 'href="connexion.php?site=Compte"'; }?>>Compte</a>
                <a class="a-menu"
                    href="mailto:gabrielle-pointeau.jeuxdedifferences@hotmail.com?subject=Demande de Contact">Contact</a>
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
        $sqlRandom = "SELECT nom_entite FROM entites ORDER BY RAND();";
        $sthRandom = $dbh->prepare($sqlRandom);
        $sthRandom -> execute();
        $motCourants = $sthRandom->fetchAll(PDO::FETCH_ASSOC);
    ?>

    <h1 class="col-sm-12 text-center align-self-center">
        <strong>
            <FONT face="Times New Roman">
                <br /><img src="./images/logo1.png" width="120" height="120" style="margin-right:20px;">Jeu de
                différences
            </FONT>
        </strong>
    </h1>
    <br />
    <h3 class="col-sm-12 text-center align-self-center">
        <FONT face="Times New Roman">
            <?php 
            if ($isLoggedIn)  {
            // Quelqu'un est connecté, sprintf 
              echo sprintf('<br/>Connect&eacute(e) en tant que %s %s', $_SESSION['utilisateur']['nom'], $_SESSION['utilisateur']['prenom']);
            } 
            else {
              echo 'Non connecté';
            }
          ?>
        </FONT>
    </h3>
    <FONT face="Times New Roman">
        <?php if ($isLoggedIn)  {
            echo "<br/><br/>";
            echo "<div id='bandeau' class='my-4 bandeau-custom' style='display:none'>";
                echo "<div id='contenu'>";
                    echo "<strong>";
                    echo "<a class='bouton' href='connexion.php'>Connexion</a>";
                    echo "<a class='bouton' href='inscription.php'>Inscription</a>";
                    echo "</strong>";
                echo "</div>";
            echo "</div>";
        }
        else{
            echo "<div id='bandeau' class='my-3 bandeau-custom' style='display:block'>";
                echo "<div id='contenu'>";
                    echo "<strong>";
                    echo "<a class='bouton' href='connexion.php'>Connexion</a>";
                    echo "<a class='bouton' href='inscription.php'>Inscription</a>";
                    //echo "<a class='bouton' href='invite.php'>Invité</a>";
                    echo "</strong>";
                echo "</div>";
            echo "</div>";
        }?>
        <div id="carousel-container"
            style="border: 1px solid black; max-width: 400px; max-height: 50px; text-align: center; margin: 10px auto 0;">

            <div id="carousel" class="carousel slide col-sm-9 align-self-center" data-ride="carousel"
                style="display: inline-block;">
                <?php foreach($motCourants as $index=>$mot){ ?>
                <div class="carousel-item <?php echo $index==0 ? 'active' : ''; ?>">
                    <h3><?php echo $mot["nom_entite"]; ?></h3>
                </div>
                <?php } ?>
            </div>
            <a class="carousel-control-prev" href="#carousel" role="button" data-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="sr-only">Previous</span>
            </a>
            <a class="carousel-control-next" href="#carousel" role="button" data-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="sr-only">Next</span>
            </a>
        </div>

    </FONT>

    <br />

    <br />

    <hr style="border-width: 2px;">
    <section id="apropos">
        <div id="apropos_image">
            <img src="./images/logo.png" width="150" height="150" />
        </div>
        <div id="apropos_texte">
            <p>
                Dans le cadre d'un projet, j'ai réalisé un jeu de différences, qui
                consiste à trouver les différences entre deux termes plus ou moins
                proches. L'idée étant qu'il n'y a pas de valeurs vrais et de valeurs
                fausses (ce n'est pas un quizz), mais l'idée et que les utilisateurs
                créent des parties, qui vont être joué par d'autre utilisateur. Le but
                étant de trouver le plus de différences possibles et de trovuer les
                différences attendues. Chaque joueur est censé gagner des points si il
                trouve les réponses attendues par le créateur de la partie, et les
                créateur gagne 10% du gain des joueur.
            </p>
        </div>
    </section>
    <hr style="border-width: 2px;">

    <br />

    <br />

    <script>
    $('.carousel').carousel({
        interval: 3000
    })
    </script>


    <footer class="row" style="margin-bottom:50px">

        <div class='col-sm-4 text-center'>
            <form>
                <a style="height: 40px; width: 200px; background:#A80000; color:white; border-radius: 10px; margin-left: 5px;"
                    href="Compte.php">Compte</a>
            </form>
            <br />
        </div>

        <div class='col-sm-4 text-center'>
            <h2>
                <strong>
                    <FONT face="Times New Roman">Jeu de différences</FONT>
                </strong>
            </h2>
        </div>

        <div class='col-sm-4 text-center'>
            <a style="height: 40px; width: 200px; background:#A80000; color:white; border-radius: 10px; margin-left: 5px;"
                href="mailto:gabrielle-pointeau.siteInternet@hotmail.com?subject=Demande de Contact">Nous
                contacter</a>
            </input>
            <!--pour nous contacter pour ouvrir une page pour leurs envoyer un mail-->
        </div>

        <br />
        <br />

    </footer>

</body>

</html>
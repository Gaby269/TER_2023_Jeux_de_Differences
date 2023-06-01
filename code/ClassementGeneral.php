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
    $idUser = $isLoggedIn ? (int)$_SESSION['utilisateur']['id_utilisateur'] : null;
    var_dump($isLoggedIn);
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
    // Récupération des données de classement
    $query = "SELECT id_utilisateur, nom, prenom, score_utilisateur FROM utilisateur ORDER BY score_utilisateur DESC";
    $stmt = $dbh->prepare($query);
    $stmt->execute();
    $classement = $stmt->fetchAll(PDO::FETCH_ASSOC);

    //var_dump($classement);

    // Affichage des données de classement dans un tableau
    echo '<table style="margin: auto;">';
        echo "<tr>
            <th>Position</th>
            <th>Nom</th>
            <th>Prenom</th>
            <th>Score</th>
        </tr>";
        $position = 1;
        foreach ($classement as $joueur) {
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

    ?>

    <br><br>



</body>

<footer>

</footer>

</html>
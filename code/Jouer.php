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
    var_dump("Connecté : ", $isLoggedIn);
    $isPartieBegin = isset($_SESSION['partieCouranteJoue']);
    var_dump("Partie commencé : ", $isPartieBegin);
    
?>


<html>

<head>
    <title>A vous de jouer !</title>

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

    .svg-button {
        background: none;
        border: none;
        cursor: pointer;
        padding: 0;
        outline: none;
        margin-left: 30px;
        margin-top: 20px;
    }

    .svg-button svg {
        height: 40px;
        width: 40px;
        fill: #000000;
    }
    </style>

    <script>
    function deletePartie() {

        fetch("./gestion_PHP/DELETE/delete_session_partie.php")
            .then(response => response.text())
            .then(data => {
                if (data == "delete") {
                    console.log('La session a été supprimée.');
                    window.location.href = "Jouer.php";
                } else {
                    console.log("noooo");
                    console.log('Erreur lors de la suppression de la session.');
                }
            })
            .catch(error => console.error(error));
    }

    function supprimerDifference(idDifference) {
        console.log("Vous avez appuyez : ", idDifference);
        const button1 = document.getElementById(idDifference + "Button1");
        const texte1 = document.getElementById(idDifference + "Texte1");
        const button2 = document.getElementById(idDifference + "Button2");
        const texte2 = document.getElementById(idDifference + "Texte2");
        fetch("./gestion_PHP/DELETE/delete_differences.php?id=" + idDifference)
            .then(response => response.text())
            .then(data => {
                console.log(data);
                if (data == "delete") {
                    button1.style.display = 'none';
                    texte1.style.display = 'none';
                    button2.style.display = 'none';
                    texte2.style.display = 'none';
                } else {}
            })
            .catch(error => console.error(error));
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
                <a class="active a-menu" href="Jouer.php">Jouer</a>
                <a class="a-menu" href="ClassementGeneral.php">Classement</a>
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
                    <br />A vous de jouer ! <br /><br />
                </FONT>
            </strong>
        </h1>
    </header>

    <form name="form_diff" method="POST">
        <?php 
      
        $partieCourante = array();
        
        //var_dump($_SESSION['partieCouranteJoue']);

        if (!$isPartieBegin) {
            
            //var_dump("<br>Coucou");
        
            // Récupérer une partie au hasard
            $sqlRandom = "SELECT * FROM parties WHERE idUtilisateur <> :idUser ORDER BY RAND() LIMIT 1;";
            $sthRandom = $dbh->prepare($sqlRandom);
            $sthRandom->bindParam(':idUser', $_SESSION['utilisateur']['id_utilisateur']);
            $sthRandom->execute();
            $partieCourante = $sthRandom->fetch(PDO::FETCH_ASSOC);
        
            // Ajout dans la session
            $_SESSION['partieCouranteJoue']["idPartie"] = (int)$partieCourante['id_parties'];
            $_SESSION['partieCouranteJoue']["idUserCourant"] = (int)$_SESSION['utilisateur']['id_utilisateur'];
            $_SESSION['partieCouranteJoue']["idUserCreate"] = (int)$partieCourante['idUtilisateur'];
        
            // Récupérer les noms des entités
            $sql = "SELECT id_entite, nom_entite FROM parties, entites WHERE (idEntite1 = id_entite OR idEntite2 = id_entite) AND id_parties = :idPartie;";
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':idPartie', $_SESSION['partieCouranteJoue']["idPartie"]);
            $sth->execute();
            $result = $sth->fetchAll(PDO::FETCH_ASSOC);
        
            // Nom des entités
            $nomEntite1 = $result[0]['nom_entite'];
            $nomEntite2 = $result[1]['nom_entite'];
            $idEntite1 = (int)$result[0]['id_entite'];
            $idEntite2 = (int)$result[1]['id_entite'];
        
            // Stocker les données de la partie courante
            $_SESSION['partieCouranteJoue']['idEntite1'] = $idEntite1;
            $_SESSION['partieCouranteJoue']['idEntite2'] = $idEntite2;
            $_SESSION['partieCouranteJoue']['nomEntite1'] = $nomEntite1;
            $_SESSION['partieCouranteJoue']['nomEntite2'] = $nomEntite2;
            
        }

        // Pour n'afficher que 
        echo "<input type='hidden' name='valDiff' id='valDiff'>";
        
        
        
        // Récueprer les différences de la partie courante (celle attendu)
        $sqlDiff = "SELECT id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference AND idPartie = :idPartie;";
        //var_dump("<br>", $sqlDiff);
        $sthDiff = $dbh->prepare($sqlDiff);
        $sthDiff -> bindParam(':idPartie', $_SESSION['partieCouranteJoue']["idPartie"]);
        $sthDiff -> bindParam(':idUser',$_SESSION['partieCouranteJoue']['idUserCreate']);
        $sthDiff->execute();
        $differencePartie = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
        //var_dump("<br>", $differencePartie);
        
        $_SESSION['partieCouranteJoue']["differencePartie"] = $differencePartie;
        
        
        // Selection des différences qu'on vient de remplir
        $sqlDiff = "SELECT id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference AND idPartie = :idPartie;";
        $sthDiff = $dbh->prepare($sqlDiff);
        $sthDiff->bindParam(':idPartie', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthDiff->bindParam(':idUser', $_SESSION['partieCouranteJoue']['idUserCourant']);
        $sthDiff->execute();
        $difference = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['partieCouranteJoue']['differenceJoueur'] = $difference;

        //var_dump($_SESSION['partieCouranteJoue']);
    ?>

        <div style="display: flex; flex-direction: row; justify-content: center;">
            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">
                <p id="premierTerme"
                    style="margin-bottom: 20px; font-size: 40px; border: 1px solid black; padding : 5px; padding-left: 10px; padding-right: 10px;">
                    <?php echo $_SESSION['partieCouranteJoue']['nomEntite1'] ?> </p>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; margin-left: 40px;">
                <p id="secondTerme"
                    style="margin-bottom: 20px; font-size: 40px; border: 1px solid black; padding : 5px; padding-left: 10px; padding-right: 10px; ">
                    <?php echo $_SESSION['partieCouranteJoue']['nomEntite2'] ?> </p>
            </div>
            <div class="svg-button" id="delete-partie" onclick="deletePartie()">
                <svg xmlns="http://www.w3.org/2000/svg" height="40px" viewBox="0 0 24 24" width="40px" fill="#000000">
                    <path d="M0 0h24v24H0z" fill="none" />
                    <path
                        d="M12 5V1L7 6l5 5V7c3.31 0 6 2.69 6 6s-2.69 6-6 6-6-2.69-6-6H4c0 4.42 3.58 8 8 8s8-3.58 8-8-3.58-8-8-8z" />
                </svg>
            </div>

        </div>

        <div style="display: flex; flex-direction: column; align-items: center;">

            <label for="champDiff1"
                style="margin-bottom: 20px; margin-top: 20px; font-size: 30px;  font-weight: bold;">Diff&eacuterences</label>
            <br>
            <select style="font-size: 20px; width: 40%;" name="typeDiff">

                <option id="val0" value="typeVal0">Choisissez un type</option>
                <?php
                    $sql = "SHOW COLUMNS FROM differences WHERE Field = 'type_diff'";
                    $stmt = $dbh->query($sql);
                    $result = $stmt->fetch(PDO::FETCH_ASSOC);
                    
                    // Récupérez les valeurs de l'énumération
                    $typeDiffValues = array();
                    if(preg_match("/^enum\(\'(.*)\'\)$/", $result['Type'], $matches)) {
                        $enumValues = explode("','", $matches[1]);
                        $typeDiffValues = $enumValues;
                    }
                    
                    // Affichez les valeurs de l'énumération
                    foreach($typeDiffValues as $value) {
                        echo '<option id="typeDiff" value="'.$value.'">'.$value.'</option>';
                    }
                ?>
            </select>
        </div>
        <div style="display: flex; justify-content: center; flex-wrap: wrap;">
            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">
                <div style="display: flex; flex: 1;">
                    <input type="text" name="valeurDiff1" class="form-control" id="champDiff1"
                        placeholder="Entrez une valeur" style="margin-top: 20px; font-size: 20px;" required>
                </div>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; margin-left: 40px;">
                <div style="display: flex; flex: 1;">
                    <input type="text" name="valeurDiff2" class="form-control" id="champDiff2"
                        placeholder="Entrez une valeur" style="margin-top: 20px; font-size: 20px;" required>
                </div>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <button type="reset" name="EffacerEntrees" id="EffacerEntrees">EFFACER</button>
            <button type="submit" name="ValiderDiff" id="ValiderDiff">Valider la différence</button>
        </div>
    </form>
    <br>
    <br>
    <div id="liste1" style="display: flex; justify-content: center; flex-wrap: wrap;">
        <div
            style="display: flex; flex-direction: column; align-items: center; margin-right: 40px; border: 1px solid black; padding: 10px;">
            <label for="champTerme1" style="font-size: 40px; margin-bottom: 20px; font-weight: bold;"> Liste du
                premier terme : </label>
            <br>
            <div class="form-group" style="flex: 1;">
                <ul>
                    <?php
                        
                        $differences = $_SESSION['partieCouranteJoue']['differenceJoueur'];
                        //var_dump($_SESSION['partieCouranteJoue']['differenceJoueur']);
                        
                        foreach ($differences as $liste1) {
                            if ($liste1['is_true_entite1']){
                                echo "<li><button id='".$liste1['id_difference']."Button1' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste1['id_difference'].")'>X</button><p id='".$liste1['id_difference']."Texte1'><span style='color: green;'>".$liste1['type_diff'] ." // ".$liste1['valeur_diff']." </span></p></li>";
                            }
                            else{
                                echo "<li><button id='".$liste1['id_difference']."Button1' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste1['id_difference'].")'>X</button><p id='".$liste1['id_difference']."Texte1'><span style='color: red;'>".$liste1['type_diff'] ." // ".$liste1['valeur_diff']." </span></p></li>";
                            }
                        }


                    ?>
                </ul>
            </div>
        </div>
        <div
            style="display: flex; flex-direction: column; align-items: center; margin-left: 40px; border: 1px solid black; padding: 10px;">
            <label for="champTerme2" style="font-size: 40px; margin-bottom: 20px; font-weight: bold;"> Liste du second
                terme : </label>
            <br>
            <div class="form-group" style="flex: 1;">
                <ul>
                    <?php   foreach ($differences as $liste2) {
                                if (!$liste2['is_true_entite1']){
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: green;'>".$liste2['type_diff'] ." // " . $liste2['valeur_diff'] . " </span></p></li>";
                                }
                                else{
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: red;'>".$liste2['type_diff'] ." // " . $liste2['valeur_diff'] . " </span></p></li>";
                                }
                            }
                    ?>
                </ul>
            </div>

        </div>
    </div>

    <?php
        

    $typeDiff = "";
    $valeurDiff1 = "";
    $valeurDiff2 = "";

    if (isset($_POST["ValiderDiff"])){

        if (isset($_POST["valDiff"])){
        ?>
    <script>
    var liste = document.getElementById("liste1").style;
    liste.display = "none";
    </script>
    <?php
        }
        //var_dump($_SESSION['partieCouranteJoue']);
        
        // Récuperer les valeurs
        $typeDiff = $_POST['typeDiff'];
        $valeurDiff1 = $_POST['valeurDiff1'];
        $valeurDiff2 = $_POST['valeurDiff2'];   
        //var_dump($valeurDiff1,  $valeurDiff2);
        
        // Différences 1 et 2
        $sqlDiff1 = "INSERT INTO differences (type_diff, valeur_diff, is_true_entite1) VALUES ('$typeDiff','$valeurDiff1', 1), ('$typeDiff', '$valeurDiff2', 0);";
        $sthDiff1 = $dbh -> prepare($sqlDiff1);
        $sthDiff1 -> execute();
        $idDiff1 = (int)$dbh -> lastInsertId();
        $idDiff2 = (int)$dbh -> lastInsertId()+1;

        // Difference lié à la partie
        $sqlPartieDiff = "INSERT INTO difference_partie (idPartie, idDifference, idUtilisateur) VALUES (:idPartie,'$idDiff1', :idUser), (:idPartie, '$idDiff2', :idUser);";
        $sthPartieDiff = $dbh -> prepare($sqlPartieDiff);
        $sthPartieDiff->bindParam(':idPartie', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthPartieDiff->bindParam(':idUser', $_SESSION['partieCouranteJoue']['idUserCourant']);
        $sthPartieDiff -> execute();
        
        
        // Selection des différences qu'on vient de remplir
        $sqlDiff = "SELECT id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE idUtilisateur = :idUser AND id_difference = idDifference AND idPartie = :idPartie;";

        $sthDiff = $dbh->prepare($sqlDiff);
        $sthDiff->bindParam(':idPartie', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthDiff->bindParam(':idUser', $_SESSION['partieCouranteJoue']['idUserCourant']);
        $sthDiff->execute();
        $differenceAll = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
        $_SESSION['partieCouranteJoue']['differenceJoueur'] = $differenceAll;
        
        //var_dump($_SESSION['partieCouranteJoue']['differenceJoueur']);
        
    
    // Affichage de la section liste2 et masquage de la section liste1
    ?>
    <div id="liste2" style="display: flex; justify-content: center; flex-wrap: wrap;">
        <div
            style="display: flex; flex-direction: column; align-items: center; margin-right: 40px; border: 1px solid black; padding: 10px;">
            <label for="champTerme1" style="font-size: 40px; margin-bottom: 20px; font-weight: bold;"> Liste du
                premier terme : </label>
            <br>
            <div class="form-group" style="flex: 1;">
                <ul>
                    <?php   foreach ($differenceAll as $liste1) {
                                if ($liste1['is_true_entite1']){
                                    echo "<li><button id='".$liste1['id_difference']."Button1' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste1['id_difference'].")'>X</button><p id='".$liste1['id_difference']."Texte1'><span style='color: green;'>".$liste1['type_diff'] ." // ".$liste1['valeur_diff']." </span></p></li>";
                                }
                                else{
                                    echo "<li><button id='".$liste1['id_difference']."Button1' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste1['id_difference'].")'>X</button><p id='".$liste1['id_difference']."Texte1'><span style='color: red;'>".$liste1['type_diff'] ." // ".$liste1['valeur_diff']." </span></p></li>";
                                }
                            }


                    ?>
                </ul>
            </div>
        </div>
        <div
            style="display: flex; flex-direction: column; align-items: center; margin-left: 40px; border: 1px solid black; padding: 10px;">
            <label for="champTerme2" style="font-size: 40px; margin-bottom: 20px; font-weight: bold;"> Liste du second
                terme : </label>
            <br>
            <div class="form-group" style="flex: 1;">
                <ul>
                    <?php   foreach ($differenceAll as $liste2) {
                                if (!$liste2['is_true_entite1']){
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: green;'>".$liste2['type_diff'] ." // " . $liste2['valeur_diff'] . " </span></p></li>";
                                }
                                else{
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: red;'>".$liste2['type_diff'] ." // " . $liste2['valeur_diff'] . " </span></p></li>";
                                }
                            }
                    ?>
                </ul>
            </div>

        </div>
    </div>
    <br><br>
    <form name="form_partie" method="POST">
        <div class="container">
            <button><a href="recapitulatifPoints.php">Valider la partie</a></button>
        </div>

    </form>
    <?php } ?>



    <br><br>


</body>

<footer>


</footer>

</html>
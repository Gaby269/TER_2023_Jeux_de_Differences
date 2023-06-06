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
    
    //var_dump(isset($_SESSION['utilisateur']));
    $isLoggedIn = isset($_SESSION['utilisateur']);
    //var_dump($isLoggedIn);
    
    if (isset($_GET['partieFini'])){
        unset($_SESSION['partieCouranteCree']);
    }
    
    //var_dump($_SESSION['partieCouranteCree']);
?>


<html>

<head>

    <meta charset="UTF-8">
    <link rel="stylesheet" href="CSS/style.css" />
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://cdn.jsdelivr.net/npm/toastify-js"></script>
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

    <title> Cr&eacuteation d'une partie</title>
    <style>
    .agrandir {
        width: 200px;
        height: 50px;
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

    <script>
    // Vérification si le mot existe dans jeudeMot
    async function checkReseau1() {

        const word1 = document.getElementById('champTerme1');
        let messageErreur1 = document.getElementById('reseauMatchError1').style;
        fetch("./gestion_PHP/CHECK/checkTermeReseau.php?word=" + word1.value)
            .then(response => response.text())
            .then(data => {
                if (data.includes('class="jdm-warning"')) {
                    messageErreur1.display = 'block';
                } else {
                    messageErreur1.display = 'none';
                }
            })
            .catch(error => console.error(error));
    }

    // Vérification si le mot existe dans jeudeMot
    async function checkReseau2() {
        const word2 = document.getElementById('champTerme2');
        let messageErreur2 = document.getElementById('reseauMatchError2').style;

        fetch("./gestion_PHP/CHECK/checkTermeReseau.php?word=" + word2.value)
            .then(response => response.text())
            .then(data => {
                if (data.includes('class="jdm-warning"')) {
                    messageErreur2.display = 'block';
                } else {
                    messageErreur2.display = 'none';
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
        fetch("./gestion_PHP/DELETE/delete_differences.php?fichier=Creer&id=" + idDifference)
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
                <a class="not a-menu">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M3 18h18v-2H3v2zm0-5h18v-2H3v2zm0-7v2h18V6H3z" />
                    </svg>
                </a>
                <a class="a-menu" href="index.php">Accueil</a>
                <a class="active a-menu" href="CreerPartie.php">Creer une partie</a>
                <a class="a-menu" href="Jouer.php">Jouer</a>
                <a class="a-menu" href="ClassementGeneral.php">Classement</a>
                <a class="a-menu" href="SesPartie.php">Mes parties</a>
                <a class="a-menu" href="Compte.php">Compte</a>
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

    <header class="row">
        <h1 class="col-sm-12 text-center align-self-center">
            <strong>
                <FONT face="Times New Roman">
                    <br />Cr&eacuteation d'une partie<br /><br />

                </FONT>
            </strong>
        </h1>
    </header>

    <br />


    <form name="form_terme" method="POST">
        <div style=" display: flex; flex-direction: row; justify-content: center;">
            <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">
                <FONT face="Times New Roman">
                    <label for="champTerme1" style="margin-bottom: 20px; font-size: 40px;  font-weight: bold;">Premier
                        terme
                        : </label>
                </FONT>
                <br>
                <input type="text" name="premierTerme" id="champTerme1" placeholder="Entrez un terme"
                    style="display: block; font-size: 30px;"
                    value="<?php echo isset($_SESSION['partieCouranteCree']['premierTerme']) ? $_SESSION['partieCouranteCree']['premierTerme'] : $_POST['premierTerme'] ?>"
                    oninput="checkReseau1()" required />
                <p id="reseauMatchError1" name="messageErreur1" style="margin-top:10px; display: none; color: red;">Le
                    mot n'existe
                    pas
                    dans la base !</p>
            </div>
            <div style="display: flex; flex-direction: column; align-items: center; margin-left: 40px;">
                <FONT face="Times New Roman">
                    <label for="champTerme2" style="margin-bottom: 20px; font-size: 40px;
                    font-weight: bold;">Second
                        terme
                        : </label>
                </FONT>
                <br>
                <input type="text" name="secondTerme" id="champTerme2" placeholder="Entrez un terme"
                    style="display: block; font-size: 30px;"
                    value="<?php echo isset($_SESSION['partieCouranteCree']['secondTerme']) ? $_SESSION['partieCouranteCree']['secondTerme'] : $_POST['secondTerme'] ?>"
                    oninput="checkReseau2()" required />
                <p id="reseauMatchError2" name="messageErreur2" style="margin-top:10px; display: none; color: red;">Le
                    mot n'existe
                    pas
                    dans la base !</p>
            </div>
        </div>
        <br>
        <br>
        <div class="container">
            <button type="reset" name="EffacerEntrees" id="EffacerEntrees">EFFACER</button>
            <button name="ValiderEntite" id="ValiderEntite">Valider les entités</button>
        </div>
    </form>

    <?php

        $nbjoueur =  (int)0;
        $is_ajoute =  (int)0;

        if (isset($_POST['ValiderEntite'])) {
            
            // Créer la partie courante
            $_SESSION['partieCouranteCree']['premierTerme'] = $_POST['premierTerme'];
            $_SESSION['partieCouranteCree']['secondTerme'] = $_POST['secondTerme'];

            // Entites
            $sqlEntite = "INSERT INTO entites (nom_entite, categorie, is_ajoute) VALUES ('".$_SESSION['partieCouranteCree']['premierTerme']."', NULL, '0'),('".$_SESSION['partieCouranteCree']['secondTerme']."', NULL, '0');";
            $sthEntite = $dbh -> prepare($sqlEntite);
            $sthEntite -> execute();
            $idEntite1 = (int)$dbh -> lastInsertId();
            $idEntite2 = (int) $dbh -> lastInsertId() + 1;
            //var_dump($idEntite1, $idEntite2);
            
            // Ajout des id dans la session
            $_SESSION['partieCouranteCree']['idPremierTerme'] = $idEntite1;
            $_SESSION['partieCouranteCree']['idSecondTerme'] = $idEntite2;

            $sqlPartie = "INSERT INTO parties (idEntite1, idEntite2, idUtilisateur, nb_joueur, is_ajoute) VALUES (:idEntite1, :idEntite2, :idUtilisateur, :nb_joueur, :is_ajoute);";
            //echo $sqlPartie;
            $sthPartie = $dbh->prepare($sqlPartie);
            $sthPartie->bindParam(':idEntite1',$idEntite1);
            $sthPartie->bindParam(':idEntite2', $idEntite2);
            $sthPartie->bindParam(':idUtilisateur', $_SESSION['utilisateur']['id_utilisateur']);
            $sthPartie->bindParam(':nb_joueur', $nbjoueur);
            $sthPartie->bindParam(':is_ajoute', $is_ajoute);
            $result = $sthPartie -> execute();
            $idPartie = (int) $dbh -> lastInsertId();
            //var_dump($idPartie);
            if (!$result) {
                print_r($sthPartie->errorInfo());
            }
            
            // Ajout de l'id de la partie dans la session
            $_SESSION['partieCouranteCree']['idPartie'] = $idPartie;
            
            var_dump($_SESSION['partieCouranteCree']);

    ?>

    <form name="form_diff" method="POST">

        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">

            <label for="champDiff1"
                style="margin-bottom: 20px; font-size: 30px;  font-weight: bold;">Différences</label>
            <br>
            <select style="margin-left: 40px; font-size: 20px; width: 40%;" name="typeDiff">

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
            <button name="ValiderDiff" id="ValiderDiff">Valider la différence</button>
        </div>
    </form>
    <br>
    <br>

    <?php

    }

    $typeDiff = "";
    $valeurDiff1 = "";
    $valeurDiff2 = "";

    if (isset($_POST['ValiderDiff'])) {
        
        var_dump($_SESSION['partieCouranteCree']);

        // Récuperer les valeurs
        $idPremierTerme =  (int)$_SESSION['partieCouranteCree']['idPremierTerme'];
        $idSecondTerme =  (int)$_SESSION['partieCouranteCree']['idSecondTerme'];
        $premierTerme = $_SESSION['partieCouranteCree']['premierTerme'];
        $secondTerme = $_SESSION['partieCouranteCree']['secondTerme'];
        $typeDiff = $_POST['typeDiff'];
        $valeurDiff1 = $_POST['valeurDiff1'];
        $valeurDiff2 = $_POST['valeurDiff2'];
        $idPartie = (int)$_SESSION['partieCouranteCree']['idPartie'];
        
        var_dump($idPremierTerme, $idSecondTerme,$premierTerme,$secondTerme,$typeDiff,$valeurDiff1,$valeurDiff2,$idPartie);
        

        // Différences 1 et 2
        $sqlDiff1 = "INSERT INTO differences (type_diff, valeur_diff, is_true_entite1) VALUES ('".$typeDiff."','".$valeurDiff1."', 1), ('".$typeDiff."', '".$valeurDiff2."', 0);";
        $sthDiff1 = $dbh -> prepare($sqlDiff1);
        $sthDiff1 -> execute();
        $idDiff1 = (int)$dbh -> lastInsertId();
        $idDiff2 = (int)$dbh -> lastInsertId()+1;

        // Difference lié à la partie
        $sqlPartieDiff = "INSERT INTO difference_partie (idPartie, idDifference, idUtilisateur) VALUES ('".$idPartie."','".$idDiff1."','".$_SESSION['utilisateur']['id_utilisateur']."'), ('".$idPartie."', '".$idDiff2."', '".$_SESSION['utilisateur']['id_utilisateur']."');";
        $sthPartieDiff = $dbh -> prepare($sqlPartieDiff);
        $sthPartieDiff -> execute();
        $idPartieDiff = (int)$dbh -> lastInsertId();
        $idPartieDiff = (int)$dbh -> lastInsertId()+1;

?>

    <form name="form_diff" method="POST">

        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">

            <label for="champDiff1"
                style="margin-bottom: 20px; font-size: 30px;  font-weight: bold;">Différences</label>
            <br>
            <select style="margin-left: 40px; font-size: 20px; width: 40%;" name="typeDiff">

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
            <button name="ValiderDiff" id="ValiderDiff">Valider la différence</button>
        </div>
        <br>
        <br>
    </form>
    <div style="display: flex; justify-content: center; flex-wrap: wrap;">

        <div
            style="display: flex; flex-direction: column; align-items: center; margin-right: 40px; border: 1px solid black; padding: 10px;">
            <label for="champTerme1" style="font-size: 40px; margin-bottom: 20px; font-weight: bold;"> Liste du
                premier terme : </label>
            <br>
            <div class="form-group" style="flex: 1;">
                <ul>
                    <?php
                        $sqlDiff = "SELECT id_difference, type_diff, valeur_diff, is_true_entite1 FROM differences, difference_partie WHERE id_difference = idDifference AND idPartie = :idPartie;";

                        $sthDiff = $dbh->prepare($sqlDiff);
                        $sthDiff->bindParam(':idPartie', $_SESSION['partieCouranteCree']['idPartie']);
                        $sthDiff->execute();

                        $differences = $sthDiff->fetchAll(PDO::FETCH_ASSOC);
                        
                        
                    ?>
                    <?php   foreach ($differences as $liste1) {
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
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: green;'>".$liste2['type_diff'] ." // ".$liste2['valeur_diff']." </span></p></li>";
                                }
                                else{
                                    echo "<li><button id='".$liste2['id_difference']."Button2' type='button' class='delete-btn' style='vertical-align: middle;' onclick='supprimerDifference(".$liste2['id_difference'].")'>X</button><p id='".$liste2['id_difference']."Texte2'><span style='color: red;'>".$liste2['type_diff'] ." // ".$liste2['valeur_diff']." </span></p></li>";
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
            <button><a href="CreerPartie.php?partieFini=true&partie_enregistree=true">Valider la partie</a></button>
        </div>
    </form>
    <?php }
    
    if (isset($_GET['partieFini']) && $_GET['partieFini']) {
        // Supprimer la variable de session
        unset($_SESSION['partieCouranteCree']);
        
        // Redirection vers CreerPartie.php
        header("Location: CreerPartie.php?partie_enregistree=true");
        exit();
    }
?>


    <link href="CSS/style_toast.css" rel="stylesheet" type="text/css">
    <script src="Toasts.js"></script>
    <script>
    // Vérifier si la partie a été enregistrée (paramètre d'URL)
    const urlParams = new URLSearchParams(window.location.search);
    const partieEnregistree = urlParams.get('partie_enregistree');

    if (partieEnregistree === 'true') {

        afficherToast();
        // Supprimer le paramètre partie_enregistree de l'URL
        supprimerParametreGET('partie_enregistree');
        supprimerParametreGET('partieFini');
    }

    function supprimerParametreGET(nomParametre) {
        if (history.replaceState) {
            const urlSansParametre = window.location.protocol + "//" + window.location.host + window.location.pathname;
            const nouveauURL = urlSansParametre + window.location.search.replace(new RegExp("([&?])" + nomParametre +
                "=[^&#]*(#[^&]*)?$"), function(match, p1, p2) {
                return (p1 === '&' ? '' : p1);
            }).replace(/^&/, '');

            // Vérifier si le nouveauURL contient encore des paramètres GET
            if (nouveauURL.indexOf('?') === -1) {
                // Si aucun autre paramètre GET, supprimer le symbole '?'
                history.replaceState({}, document.title, nouveauURL.replace('?', ''));
            } else {
                history.replaceState({}, document.title, nouveauURL);
            }
        }
    }




    // Fonction pour afficher le toast
    function afficherToast() {
        const toasts = new Toasts({
            offsetX: 20, // 20px
            offsetY: 20, // 20px
            gap: 20, // The gap size in pixels between toasts
            width: 300, // 300px
            timing: 'ease', // See list of available CSS transition timings
            duration: '.5s', // Transition duration
            dimOld: true, // Dim old notifications while the newest notification stays highlighted
            position: 'top-right' // top-left | top-center | top-right | bottom-left | bottom-center | bottom-right
        });
        toasts.push({
            title: 'Parties',
            content: 'Votre partie a bien été enregistré',
            style: 'success'
        });
    }
    </script>




    <br><br>
    <br>


</body>


</html>
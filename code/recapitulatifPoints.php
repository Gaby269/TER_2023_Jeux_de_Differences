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

<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <title>Résultats ! </title>

    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <style>
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
                <?php if ($isLoggedIn)  {?><a style="float: right;" href="logout.php">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path
                            d="M17 7l-1.41 1.41L18.17 11H8v2h10.17l-2.58 2.58L17 17l5-5zM4 5h8V3H4c-1.1 0-2 .9-2 2v14c0 1.1.9 2 2 2h8v-2H4V5z" />
                    </svg>
                </a><?php }?>
                <?php if ($isLoggedIn)  {?><a style="float: left;" href="index.php?partieJoueFini=true">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px"
                        fill="#000000">
                        <path d="M0 0h24v24H0z" fill="none" />
                        <path d="M20 11H7.83l5.59-5.59L12 4l-8 8 8 8 1.41-1.41L7.83 13H20v-2z" />
                    </svg>
                </a><?php }?>
            </ul>
        </nav>
    </header>

    <?php 

      function formate($ligne) {
        $ligne = strtolower($ligne);
        $accents = array(
            'a' => array('à', 'ã', 'á', 'â'),
            'e' => array('é', 'è', 'ê', 'ë'),
            'i' => array('î', 'ï'),
            'u' => array('ù', 'ü', 'û'),
            'o' => array('ô', 'ö'),
            '' => array(' ', '-', '_', '\'', '(', ')', '"')
        );
        foreach ($accents as $char => $accented_chars) {
            foreach ($accented_chars as $accented_char) {
                $ligne = str_replace($accented_char, $char, $ligne);
            }
        }
        return $ligne;
    }
    
    ?>


    <h1 align="center">Résultats !</h1>
    <br><br>
    <div style=" display: flex; flex-direction: row; justify-content: center;">
        <div style="display: flex; flex-direction: column; align-items: center; margin-right: 40px;">
            <p id="premierTerme"
                style="margin-bottom: 20px; font-size: 40px; border: 1px solid black; padding : 5px; padding-left: 10px; padding-right: 10px;">
                <?php echo $_SESSION['partieCouranteJoue']["nomEntite1"] ?> </p>
        </div>
        <div style="display: flex; flex-direction: column; align-items: center; margin-left: 40px;">
            <p id="secondTerme"
                style="margin-bottom: 20px; font-size: 40px; border: 1px solid black; padding : 5px; padding-left: 10px; padding-right: 10px; ">
                <?php echo $_SESSION['partieCouranteJoue']["nomEntite2"] ?> </p>
        </div>
    </div>

    <?php

        $cpt = 0;
        $nbDifferenceAttendu = count($_SESSION['partieCouranteJoue']['differencePartie']);
        $nbDifferenceRepondu = count($_SESSION['partieCouranteJoue']['differenceJoueur']);
        if ($nbDifferenceAttendu == null){
            $cpt = 0;
            $nbDifferenceAttendu = 0;
        }
        if ($nbDifferenceRepondu == null){
            $nbDifferenceRepondu = 0;
        }
        //var_dump($nbDifferenceAttendu, $nbDifferenceRepondu);
        foreach($_SESSION['partieCouranteJoue']['differencePartie'] as $diffAttenduCourante){
            foreach($_SESSION['partieCouranteJoue']['differenceJoueur'] as $diffReponduCourante){
                if ($diffAttenduCourante['type_diff'] == $diffReponduCourante['type_diff'] && formate($diffAttenduCourante['valeur_diff']) == formate($diffReponduCourante['valeur_diff']) && $diffAttenduCourante['is_true_entite1'] == $diffReponduCourante['is_true_entite1']){
                    $cpt++;
                }
            }
        }
        $pourcentage = -1;
        if ($nbDifferenceAttendu == 0){
            $pourcentage = 0;
        }
        else{
            $pourcentage = ($cpt*100)/$nbDifferenceAttendu;
        }
        
    ?>

    <p id="pourcentage" style="margin-bottom: 20px; font-size: 40px; text-align: center;">
        <?php echo $pourcentage;
            if ($pourcentage < 100){
                if ($pourcentage > 80){
                    echo "% de réponse attendu ! Vous y êtes presque ! ";
                }
                else if ($pourcentage > 50){
                    echo "% de réponse attendu ! Plus que la moitié ! ";
                }
                else if ($pourcentage > 25){
                    echo "% de réponse attendu ! Il en manque ! ";
                }
                else{
                    echo "% de réponse attendu !";
                }
            }
            else{
                echo "% de réponse attendu ! Bien joué vous avez tout trouvé";
            }
        ?>
    </p>

    <p id="point" style="margin-bottom: 80px; font-size: 40px; text-align: center;">
        <?php 
        $point = 0;
        if ($pourcentage < 100){
            if ($pourcentage > 80){
                $point = 80;
            }
            else if ($pourcentage > 50){
                $point = 50;
            }
            else if ($pourcentage > 25){
                $point = 25;
            }
            else{
                $point = 10;
            }
        }
        else{
            $point = 100;
        }
        if ($nbDifferenceRepondu - $cpt > $nbDifferenceAttendu - $cpt){
            $point+=10;
        }
        echo "Vous gagnez $point points pour toutes vos réponses !";
            
        ?>
    </p>

    <?php
    
        
        // Recuperer le nombre de joueur de la partie
        $sqlPartie = "SELECT * FROM partie_jouer WHERE idUtilisateur = :idU AND idPartie = :idP;";
        $sthPartie = $dbh-> prepare($sqlPartie);
        $sthPartie->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
        $sthPartie->bindParam(':idP', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthPartie -> execute();
        $partie = $sthPartie->fetch(PDO::FETCH_ASSOC);
        $scoreActuel = $partie['score'];
        //var_dump($partie);
        if ($partie === false){
            var_dump("La partie n'a pas été trouvé");
            // Partie jouer par l'utilisateur
            $sqlPartie = "INSERT INTO partie_jouer (idPartie, idUtilisateur, score, pourcentage, nb_fois_jouer) VALUES (:idP, :idU, :point, :pourcentage, 1);";
            $sthPartie = $dbh -> prepare($sqlPartie);
            $sthPartie->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
            $sthPartie->bindParam(':idP', $_SESSION['partieCouranteJoue']['idPartie']);
            $sthPartie->bindParam(':point', $point);
            $sthPartie->bindParam(':pourcentage', $pourcentage);
            $sthPartie -> execute();
        }
        else{
            var_dump("La parti a été trouvé");
            $nb_fois_plus = $partie['nb_fois_jouer'] + 1;
            // Mettre à jour le nombre de joueur qui a jouer à la partie
            $sqlPartie = "UPDATE partie_jouer SET nb_fois_jouer = :nbJouer WHERE idUtilisateur = :idU AND idPartie = :idP;";
            $sthPartie = $dbh -> prepare($sqlPartie);
            $sthPartie->bindParam(':nbJouer', $nb_fois_plus);
            $sthPartie->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
            $sthPartie->bindParam(':idP', $_SESSION['partieCouranteJoue']['idPartie']);
            $sthPartie -> execute();
            // Update aussi le nombre de points
            $sqlPartie = "UPDATE partie_jouer SET score = :score, pourcentage = :pour WHERE idUtilisateur = :idU AND idPartie = :idP;";
            $sthPartie = $dbh -> prepare($sqlPartie);
            $sthPartie->bindParam(':score', $point);
            $sthPartie->bindParam(':pour', $pourcentage);
            $sthPartie->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
            $sthPartie->bindParam(':idP', $_SESSION['partieCouranteJoue']['idPartie']);
            $sthPartie -> execute();
        }
        
        
        // Recuperer le score du joueur actuel
        $sqlScore = "SELECT score_utilisateur FROM utilisateur WHERE id_utilisateur = :id";
        $sthScore = $dbh-> prepare($sqlScore);
        $sthScore->bindParam(':id', $_SESSION['utilisateur']['id_utilisateur']);
        $sthScore -> execute();
        $scoreCourant1 = $sthScore->fetch(PDO::FETCH_ASSOC)['score_utilisateur'];
        $scoreFinal = $scoreCourant1 + ($point-$scoreActuel);
        // Mettre à jour le score de l'utilisateur
        $sqlJouer = "UPDATE utilisateur SET score_utilisateur = :score WHERE id_utilisateur = :id;";
        $sthJouer = $dbh -> prepare($sqlJouer);
        $sthJouer->bindParam(':score', $scoreFinal);
        $sthJouer->bindParam(':id', $_SESSION['utilisateur']['id_utilisateur']);
        $sthJouer -> execute();
        
        // Recuperer le score du joueur qui a créé la partie 10% de ce que le joueur gagne
        $sqlScore = "SELECT score_utilisateur FROM utilisateur WHERE id_utilisateur = :id";
        $sthScore = $dbh-> prepare($sqlScore);
        $sthScore->bindParam(':id', $_SESSION['partieCouranteJoue']['idUserCreate']);
        $sthScore -> execute();
        $scoreCourant2 = $sthScore->fetch(PDO::FETCH_ASSOC)['score_utilisateur'];
        $scoreFinal = $scoreCourant2 + ($point-$scoreActuel)*0.10;
        //var_dump($scoreFinal);
        // Mettre à jour le score de l'utilisateur
        $sqlJouer = "UPDATE utilisateur SET score_utilisateur = :idScore WHERE id_utilisateur = :id;";
        $sthJouer = $dbh -> prepare($sqlJouer);
        $sthJouer->bindParam(':idScore', $scoreFinal);
        $sthJouer->bindParam(':id', $_SESSION['partieCouranteJoue']['idUserCreate']);
        $sthJouer -> execute();
        
        // Recuperer le nombre de joueur de la partie
        $sqlNb = "SELECT nb_joueur FROM parties WHERE id_parties = :id";
        $sthNb = $dbh-> prepare($sqlNb);
        $sthNb->bindParam(':id', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthNb -> execute();
        $nbJoueur = $sthNb->fetch(PDO::FETCH_ASSOC)['nb_joueur'];
        $nb_joueur = $nbJoueur + 1;
        // Mettre à jour le nombre de joueur qui a jouer à la partie
        $sqlNbJouer = "UPDATE parties SET nb_joueur = :nbJouer WHERE id_parties = :id;";
        $sthNbJouer = $dbh -> prepare($sqlNbJouer);
        $sthNbJouer->bindParam(':nbJouer', $nb_joueur);
        $sthNbJouer->bindParam(':id', $_SESSION['partieCouranteJoue']['idPartie']);
        $sthNbJouer -> execute();
        
        
        //selection de l'identificateur du mail de la personne qui vient de sinscrire
        $use = "SELECT * FROM utilisateur WHERE id_utilisateur = '".$_SESSION['utilisateur']['id_utilisateur']."';";
        //execution
        $sth = $dbh->query($use);
        if (!$sth) die("Impossible d'éxécuter la requête !");
        $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
        $_SESSION['utilisateur'] = $utilisateur;
        
        
    ?>



</body>

<footer>

</footer>

</html>
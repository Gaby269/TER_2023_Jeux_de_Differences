<!DOCTYPE html>
<?php
session_start();
session_destroy();
session_start();

//$dsn="mysql:host=localhost;dbname=ter_2023_differences";
$dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
//$username="root";
$username = "id20747577_root"; 
//$password="";
$password = "0109LeoGaby*";
$options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
$dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");

?>

<html>

<head>
    <title>Accueil</title>
    <link rel="icon" href="images/logo.png" type="image/x-icon">
    <style>
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


    div.formulaire {
        text-align: center;
    }

    fieldset {
        width: 100%;
        margin: auto;
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
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script>
    // Verification du mot de passe 
    function checkPasswordMatch() {
        // Récupération des valeurs des deux champs de saisie
        const password = document.getElementById('motdepasseUtilisateur').value;
        const confirmPassword = document.getElementById('confmotdepasseUtilisateur').value;

        // Vérification si les deux valeurs sont identiques
        if (password !== confirmPassword) {
            // Affichage du message d'erreur
            document.getElementById('passwordMatchError').style.display = 'block';
        } else {
            // Cacher le message d'erreur
            document.getElementById('passwordMatchError').style.display = 'none';
        }
    }

    function checkEmailMatch() {
        const email = document.getElementById('adresseUtilisateur').value;
        const error = document.getElementById('emailError');

        if (email.length > 0) {
            fetch("./gestion_PHP/CHECK/checkEmail.php?email=" + email)
                .then(response => response.text())
                .then(data => {
                    if (data.includes('exists')) {
                        // L'email existe donc c'est aps bien
                        error.style.display = 'block';
                    } else {
                        error.style.display = 'none';
                    }
                })
                .catch(error => console.error(error));
        } else {
            // Si l'utilisateur efface l'e-mail, masquer le message d'erreur
            error.style.display = 'none';
        }
    }


    function Afficher1() {
        var input = document.getElementById("motdepasseUtilisateur");
        var boutonVisuel = document.getElementById("visuel1");
        if (input.type === "password") {
            input.type = "text";
            boutonVisuel.innerHTML =
                '<svg id="visuel1" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"> <path d="M0 0h24v24H0z" fill="none" /> <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" /> </svg>';
        } else {
            input.type = "password";
            boutonVisuel.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"><path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>';
        }
    }

    function Afficher2() {
        var input = document.getElementById("confmotdepasseUtilisateur");
        var boutonVisuel = document.getElementById("visuel2");
        if (input.type === "password") {
            input.type = "text";
            boutonVisuel.innerHTML =
                '<svg id="visuel2" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"> <path d="M0 0h24v24H0z" fill="none" /> <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" /> </svg>';
        } else {
            input.type = "password";
            boutonVisuel.innerHTML =
                '<svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"><path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>';
        }
    }
    </script>
</head>

<body>

    <div id="contenu">
        <strong>
            <FONT face="Times New Roman">
                <a class="bouton" href="connexion.php">Connexion</a>
            </FONT>
        </strong>
    </div>

    <?php
      // Inscription
      if (isset($_GET['Inscription'])) {
        
        $email = $_GET['adresseUtilisateur'];
        $password = $_GET['motdepasseUtilisateur'];
            
        //insertion de base de l'inscription
        if ($password == $_GET['confmotdepasseUtilisateur']){
            
            // Vérifier si l'email est déjà utilisé
            $sql = "SELECT COUNT(*) AS count FROM utilisateur WHERE email = :email";
            $stmt = $dbh->prepare($sql);
            $stmt->bindParam(':email', $_GET['email'], PDO::PARAM_STR);
            $stmt->execute();
            $count = $stmt->fetch(PDO::FETCH_ASSOC);

	        $sql = "INSERT INTO utilisateur (prenom, nom, date_naissance, age, email, mot_de_passe, is_admin, images) VALUES (:prenom,:nom,:date,:age,:email,:mdp, 0, NULL);";
            //execution
            $sth = $dbh->prepare($sql);
            $sth->bindParam(':prenom', $_GET['prenomUtilisateur']);
            $sth->bindParam(':nom', $_GET['nomUtilisateur']);
            $sth->bindParam(':date', $_GET['dateNaissanceUtilisateur']);
            $sth->bindParam(':age', $_GET['ageUtilisateur']);
            $sth->bindParam(':email', $_GET['adresseUtilisateur']);
            $sth->bindParam(':mdp', $_GET['motdepasseUtilisateur']);
            $sth->execute();
        
            //selection de l'identificateur du mail de la personne qui vient de sinscrire
            $use = "SELECT * FROM utilisateur WHERE email = '".$_GET['adresseUtilisateur']."' LIMIT 1;";
            //execution
            $sth = $dbh->query($use);
            if (!$sth) die("Impossible d'éxécuter la requête !");
            $utilisateur = $sth->fetch(PDO::FETCH_ASSOC);
        }
        else{
            die("Les deux mot de passe sont différents !");
        }

        $_SESSION['utilisateur'] = $utilisateur;
        // Redirection vers une nouvelle page
        header("Location: index.php");
        exit; // Assurez-vous d'utiliser exit() après la redirection pour arrêter l'exécution du script actuel


      }
      
    ?>

    <fieldset>
        <FONT face="Times New Roman">
            <h2 align="center"><strong>Inscription</strong></h1>
        </FONT>
        <div class="formulaire">
            <form>
                <div class="form-group">
                    <!--MAIL-->
                    <br />
                    <div
                        style="display: grid; grid-template-columns: 1fr 1fr; align-items: center; justify-items: center;">
                        <!--NOM-->
                        <label for="nomUtilisateur" style="text-align: left; padding-left: 300px;"><strong>Nom de
                                l'utilisateur :</strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="text" name="nomUtilisateur" id="nomUtilisateur"
                                style="height: 40px; width: 300px;" placeholder=" Entrez un Nom en majuscule... "
                                required />
                        </div>
                        <!--PRENOM-->
                        <label for="prenomUtilisateur"
                            style="text-align: left; padding-left: 300px;"><strong>Pr&eacutenom
                                de
                                l'utilisateur :</strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="text" name="prenomUtilisateur" id="prenomUtilisateur"
                                style="height: 40px; width: 300px;" placeholder=" Entrez un Prenom... " required />
                        </div>
                        <!--DATE DE NAISSANCE-->
                        <label for="dateNaissanceUtilisateur"
                            style="text-align: left; padding-left: 300px;"><strong>Date
                                de Naissance :</strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="date" name="dateNaissanceUtilisateur" id="dateNaissanceUtilisateur"
                                style="height: 40px; width: 300px;" required />
                        </div>
                        <!--AGE-->
                        <label for="ageUtilisateur" style="text-align: left; padding-left: 300px;"><strong>Age
                                :</strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="number" name="ageUtilisateur" id="ageUtilisateur"
                                style="height: 40px; width: 300px;" placeholder=" Entrez un age... " required />
                        </div>
                        <!--MAIL-->
                        <label for="adresseUtilisateur" style="text-align: left; padding-left: 300px;"><strong>Adresse
                                Mail : </strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="email" name="adresseUtilisateur" id="adresseUtilisateur"
                                style="height: 40px; width: 300px;" placeholder="Entrez une adresse mail..."
                                oninput="checkEmailMatch()" required />
                            <p id="emailError" style="display: none; color: red; margin-left:10px; margin-top: 8px;">
                                E-mail d&eacutej&agrave utilis&eacute.
                            </p>
                        </div>
                        <!--MOT DE PASSE-->
                        <label for="motdepasseUtilisateur" style="text-align: left; padding-left: 300px;"><strong>Mot
                                de
                                Passe : </strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="password" name="motdepasseUtilisateur" style="height: 40px; width: 260px;"
                                placeholder="Entrez un mot de passe..." id="motdepasseUtilisateur" required />
                            <button type="button"
                                style="height: 40px; width: 40px; background:#A80000; color:white; border-radius: 5px; border: none; vertical-align: top;"
                                onclick="Afficher1()">
                                <svg id="visuel1" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                    width="20px" fill="white">
                                    <path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z" />
                                </svg>
                            </button>
                        </div>
                        <!--CONFIRMATION MOT DE PASSE-->
                        <label for="confmotdepasseUtilisateur"
                            style=" text-align: left; padding-left: 300px;"><strong>Confirmation du Mot de Passe
                                :</strong></label>
                        <div class="input-group" style="margin-left:84px">
                            <input type="password" name="confmotdepasseUtilisateur" style="height: 40px; width: 260px;"
                                placeholder=" Entrez un mot de passe... " id="confmotdepasseUtilisateur"
                                oninput="checkPasswordMatch()" required />
                            <button type="button"
                                style="height: 40px; width: 40px; background:#A80000; color:white; border-radius: 5px; border: none; vertical-align: top;"
                                onclick="Afficher2()">
                                <svg id="visuel2" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                    width="20px" fill="white">
                                    <path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none" />
                                    <path
                                        d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z" />
                                </svg>
                            </button>
                            <p id="passwordMatchError"
                                style="display: none; color: red; margin-left:10px; margin-top: 8px;">Les mots de passe
                                ne sont pas &eacutegaux.</p>
                        </div>
                    </div><br /><br />
                    <input type="submit" value="S'INSCRIRE" name="Inscription"
                        style="height: 40px; width: 200px; background:#A80000; color:white; border-radius: 10px; margin-left: 5px;" />
                </div>
            </form>
        </div>

    </fieldset>


</body>

</html>
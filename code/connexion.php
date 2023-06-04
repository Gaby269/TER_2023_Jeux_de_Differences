<!DOCTYPE html>
<?php session_start();

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
    <title>Connexion</title>
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
        width: 60%;
        margin: auto;
    }
    </style>
    <link rel="stylesheet" href="CSS/style.css" />

</head>



<body>

    <script>
    //Connexion
    function VerifierIdentifiant() {
        const password = document.getElementById('mdpUtilisateur').value;
        const email = document.getElementById('mailUtilisateur').value;
        const erreur = document.getElementById('messageErreur').style;

        console.log(password, email);
        if (email.length > 0 && password.length > 0) {
            fetch("./gestion_PHP/CHECK/checkIdentifiant.php?email=" + email + "&password=" + password)
                .then(response => response.text())
                .then(data => {
                    if (data != "") {
                        console.log(data);
                        erreur.display = 'none';
                    } else {
                        console.log("noooo");
                        erreur.display = 'block';
                    }
                })
                .catch(error => console.error(error));
        } else {
            // Si l'utilisateur efface l'e-mail ou le mot de passe
            erreur.display = 'none';
        }

    }

    function Afficher() {
        var input = document.getElementById("mdpUtilisateur");
        var boutonVisuel = document.getElementById("visuel");
        if (input.type === "password") {
            input.type = "text";
            boutonVisuel.innerHTML =
                '<svg id="visuel" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"> <path d="M0 0h24v24H0z" fill="none" /> <path d="M12 4.5C7 4.5 2.73 7.61 1 12c1.73 4.39 6 7.5 11 7.5s9.27-3.11 11-7.5c-1.73-4.39-6-7.5-11-7.5zM12 17c-2.76 0-5-2.24-5-5s2.24-5 5-5 5 2.24 5 5-2.24 5-5 5zm0-8c-1.66 0-3 1.34-3 3s1.34 3 3 3 3-1.34 3-3-1.34-3-3-3z" /> </svg>';
        } else {
            input.type = "password";
            boutonVisuel.innerHTML =
                '<svg id="visuel" xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 0 24 24" width="24px" fill="white"><path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none"/><path d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z"/></svg>';
        }
    }

    function VerifierAffichage() {
        const mdpUtilisateur = document.getElementById('mdpUtilisateur');
        const mailUtilisateur = document.getElementById('mailUtilisateur');
        const messageErreur = document.getElementById('messageErreur');
        if (messageErreur.style.display === 'block' && mdpUtilisateur.value.length != 0 && mailUtilisateur.value
            .length != 0) {
            return false; // Empêcher la soumission du formulaire
        } else {
            return true; // Autoriser la soumission du formulaire
        }
    }
    </script>
    <br />
    <br />
    <fieldset>
        <br />
        <h1 align="center">Connexion</h1>
        <div class="formulaire">
            <form method="POST" <?php  if (!$pVisible){
                                        if (isset($_GET['site'])){
                                            if($_GET['site'] == "Partie"){
                                                echo "action='CreerPartie.php'";
                                            }
                                            else if ($_GET['site'] == "Jouer"){
                                                echo "action='Jouer.php'";
                                            }
                                            else if ($_GET['site'] == "Classement"){
                                                echo "action='ClassementGeneral.php'";
                                            }
                                            else if ($_GET['site'] == "MesParties"){
                                                echo "action='SesPartie.php'";
                                            }
                                            else if ($_GET['site'] == "Compte"){
                                                echo "action='Compte.php'";
                                            }
                                            else {
                                                echo "action='index.php'";
                                            }
                                        }
                                        else{
                                            echo "action='index.php'";
                                        }
                                    }
                                    else{
                                        echo "action='connexion.php'";
                                    }
            
                                    ?>>
                <div class="form-group">
                    <!--MAIL-->
                    <br />
                    <input type="text" name="mailUtilisateur" id="mailUtilisateur" oninput="VerifierIdentifiant()"
                        placeholder=" Entrez un mail... " style="height: 40px; width: 300px;" required /><br /><br />
                    <!--MOT DE PASSE-->
                    <div class="input-group">
                        <input type="password" name="mdpUtilisateur" id="mdpUtilisateur"
                            placeholder=" Entrez un mot de passe... " style="height: 40px; width: 255px;"
                            id="motdepasse" oninput="VerifierIdentifiant()" required />
                        <button type="button"
                            style="height: 40px; width: 40px; background:#A80000; color:white; border-radius: 5px; border: none; vertical-align: top;"
                            onclick="Afficher()">
                            <svg id="visuel" xmlns="http://www.w3.org/2000/svg" height="20px" viewBox="0 0 24 24"
                                width="20px" fill="white">
                                <path d="M0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0zm0 0h24v24H0z" fill="none" />
                                <path
                                    d="M12 7c2.76 0 5 2.24 5 5 0 .65-.13 1.26-.36 1.83l2.92 2.92c1.51-1.26 2.7-2.89 3.43-4.75-1.73-4.39-6-7.5-11-7.5-1.4 0-2.74.25-3.98.7l2.16 2.16C10.74 7.13 11.35 7 12 7zM2 4.27l2.28 2.28.46.46C3.08 8.3 1.78 10.02 1 12c1.73 4.39 6 7.5 11 7.5 1.55 0 3.03-.3 4.38-.84l.42.42L19.73 22 21 20.73 3.27 3 2 4.27zM7.53 9.8l1.55 1.55c-.05.21-.08.43-.08.65 0 1.66 1.34 3 3 3 .22 0 .44-.03.65-.08l1.55 1.55c-.67.33-1.41.53-2.2.53-2.76 0-5-2.24-5-5 0-.79.2-1.53.53-2.2zm4.31-.78l3.15 3.15.02-.16c0-1.66-1.34-3-3-3l-.17.01z" />
                            </svg>
                        </button>
                    </div>
                    <p id="messageErreur"
                        style="display: <?php echo $pVisibilite ? 'block' : 'none'; ?>; margin-top:20px; color: red; display:none;">
                        L'adresse mail ou le mot de passe est
                        incorrect.
                        Recommencez</p>


                </div>
                <br />
                <br />
                <input type="submit" value="SE CONNECTER" name="Connexion"
                    style="height: 40px; width: 200px; background:#A80000; color:white; border-radius: 10px; margin-left: 5px;"
                    onclick="return VerifierAffichage();" />
                <br />
            </form>
        </div>
        <br />
    </fieldset>



    <div id="bandeau" class="my-3 bandeau-custom">
        <div id="contenu">
            <strong>
                <a class="bouton" href="inscription.php">Inscription</a>
            </strong>
        </div>
    </div>



</body>

</html>
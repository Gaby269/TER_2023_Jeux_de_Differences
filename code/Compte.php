<!doctype html>
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
    $id_user = $_SESSION['utilisateur']['id_utilisateur'];
    $isLoggedIn = isset($_SESSION['utilisateur']);
    //var_dump($isLoggedIn, $id_user);
    
?>


<html lang="fr">

<head>
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

    <title> Menu </title>

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

    .agrandir {
        width: 200px;
        height: 50px;
    }

    div.formulaire {
        text-align: center;
    }

    .container {
        width: 50%;
        margin: auto;
        border: 1px solid black;
        padding: 10px;
    }
    </style>

    <script>
    function Afficher() {
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

    function modifierNom() {
        const texteElement = document.getElementById('texteNom');
        const changeNomIcon = document.getElementById('change_nom_icon');
        const nomModifier = document.getElementById('champNom');
        const erreur = document.getElementById('erreur');

        if (nomModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            nomModifier.style.display = 'inline-block';
            nomModifier.value = texteElement.textContent;
            nomModifier.focus();

        } else {
            if (nomModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php?nom=" + nomModifier.value)
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            texteElement.style.display = 'inline-block';
                            nomModifier.style.display = 'none';
                            texteElement.textContent = nomModifier.value;
                            afficherToastSuccess('nom');
                        } else {
                            afficherToastError('nom');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le nom dire qu'il faut une valeur
                erreur.display = 'block';
            }
        }
    }

    function modifierPrenom() {
        const texteElement = document.getElementById('textePrenom');
        const changePrenomIcon = document.getElementById('change_prenom_icon');
        const prenomModifier = document.getElementById('champPrenom');
        const erreur = document.getElementById('erreur');

        if (prenomModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            prenomModifier.style.display = 'inline-block';
            prenomModifier.value = texteElement.textContent;
            prenomModifier.focus();

        } else {
            if (prenomModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php?prenom=" + prenomModifier.value)
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            texteElement.style.display = 'inline-block';
                            prenomModifier.style.display = 'none';
                            texteElement.textContent = prenomModifier.value;
                            afficherToastSuccess('prenom');
                        } else {
                            afficherToastError('prenom');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le prenom
                erreur.display = 'block';
            }
        }
    }

    function modifierAge() {
        const texteElement = document.getElementById('texteAge');
        const changeAgeIcon = document.getElementById('change_age_icon');
        const ageModifier = document.getElementById('champAge');
        const erreur = document.getElementById('erreur');
        console.log(ageModifier.value, "./gestion_PHP/UPDATE/updateCompte.php?age=" + ageModifier.value);

        if (ageModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            ageModifier.style.display = 'inline-block';
            ageModifier.value = texteElement.textContent;
            ageModifier.focus();

        } else {
            if (ageModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php?age=" + ageModifier.value)
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            console.log("update");
                            texteElement.style.display = 'inline-block';
                            ageModifier.style.display = 'none';
                            texteElement.textContent = ageModifier.value;
                            afficherToastSuccess('age');
                        } else {
                            console.log("nooo");
                            afficherToastError('age');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le age dire qu'il faut une valeur
                erreur.display = 'block';
            }
        }
    }



    function modifierDate() {
        const texteElement = document.getElementById('texteDate');
        const changeDateIcon = document.getElementById('change_date_icon');
        const dateModifier = document.getElementById('champDate');
        const erreur = document.getElementById('erreur');

        if (dateModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            dateModifier.style.display = 'inline-block';
            dateModifier.value = texteElement.textContent;
            dateModifier.focus();

        } else {
            if (dateModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php?date=" + dateModifier.value)
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            texteElement.style.display = 'inline-block';
                            dateModifier.style.display = 'none';
                            texteElement.textContent = dateModifier.value;
                            afficherToastSuccess('date');
                        } else {
                            afficherToastError('date');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le date dire qu'il faut une valeur
                erreur.display = 'block';
            }
        }
    }

    function modifierMail() {
        const texteElement = document.getElementById('texteMail');
        const changeMailIcon = document.getElementById('change_mail_icon');
        const mailModifier = document.getElementById('champMail');
        const erreur = document.getElementById('erreur');

        if (mailModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            mailModifier.style.display = 'inline-block';
            mailModifier.value = texteElement.textContent;
            mailModifier.focus();

        } else {
            texteElement.style.display = 'inline-block';
            mailModifier.style.display = 'none';
            texteElement.textContent = mailModifier.value;
            if (mailModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php?mail=" + mailModifier.value)
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            afficherToastSuccess('mail');
                        } else {
                            afficherToastError('mail');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le mail dire qu'il faut une valeur
                erreur.display = 'block';
            }
        }
    }

    function modifierMdp() {
        const texteElement = document.getElementById('texteMdp');
        const changeMdpIcon = document.getElementById('change_mdp_icon');
        const mdpModifier = document.getElementById('champMdp');
        const erreur = document.getElementById('erreur');

        if (mdpModifier.style.display === 'none') {
            texteElement.style.display = 'none';
            mdpModifier.style.display = 'inline-block';
            mdpModifier.value = <?php echo $_SESSION['utilisateur']['mot_de_passe']; ?>;
            mdpModifier.focus();

        } else {
            texteElement.style.display = 'inline-block';
            mdpModifier.style.display = 'none';
            const longueurMotDePasse = mdpModifier.value.length;
            const motDePasseCache = "*".repeat(longueurMotDePasse);
            texteElement.textContent = motDePasseCache;
            // Modifier dans la base les infos
            if (mdpModifier.value.length > 0) {
                fetch("./gestion_PHP/UPDATE/updateCompte.php", {
                        method: "POST",
                        headers: {
                            "Content-Type": "application/x-www-form-urlencoded"
                        },
                        body: "mdp=" + encodeURIComponent(mdpModifier.value)
                    })
                    .then(response => response.text())
                    .then(data => {
                        console.log(data);
                        if (data == "update") {
                            afficherToastSuccess('mdp');
                        } else {
                            afficherToastError('mdp');
                        }
                    })
                    .catch(error => console.error(error));
            } else {
                // Si l'utilisateur efface le mdp dire qu'il faut une valeur
                erreur.display = 'block';
            }
        }
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
                <a class="a-menu" href="SesPartie.php">Mes parties</a>
                <a class="active a-menu" href="Compte.php">Compte</a>
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

    <br />
    <h1 class="col-sm-12 text-center align-self-center">
        <strong>
            <FONT face="Times New Roman">
                Votre compte :<br />
            </FONT>
        </strong>
    </h1>
    <br />
    <br />

    <hr>


    <div>
        <!--Vos informations-->
        <strong>
            <font face="Times New Roman" size="5" style="padding-left:50px">Informations : </font>
        </strong>
        <br /><br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman"><span size="3" style="padding-left:100px; margin-right:5px">NOM DE FAMILLE
                        :
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php echo '<div  id="texteNom" style="display:inline-block; margin-right:5px;">'.$_SESSION['utilisateur']['nom'].'</div>';?>
                <input type="text" name="champNom" id="champNom" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id=change_nom_icon onclick="modifierNom()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000" style="margin-left: 10px;">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
        </div>
        <br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman"><span size="3" style="padding-left:100px; margin-right:5px">PRENOM :
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php echo '<div  id="textePrenom" style="display:inline-block; margin-right:5px;">'.$_SESSION['utilisateur']['prenom'].'</div>';?>
                <input type="text" name="champPrenom" id="champPrenom" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id=change_prenom_icon onclick="modifierPrenom()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000" style="margin-left: 10px;">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
        </div>
        <br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman"><span size="3" style="padding-left:100px; margin-right:5px">AGE :
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php echo '<div  id="texteAge" style="display:inline-block; margin-right:5px;">'.$_SESSION['utilisateur']['age'].'</div>';?>
                <input type="text" name="champAge" id="champAge" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id=change_age_icon onclick="modifierAge()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000" style="margin-left: 10px;">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
        </div>
        <br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman"><span size="3" style="padding-left:100px; margin-right:5px">DATE DE
                        NAISSANCE :
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php echo '<div  id="texteDate" style="display:inline-block; margin-right:5px;">'.$_SESSION['utilisateur']['date_naissance'].'</div>';?>
                <input type="text" name="champDate" id="champDate" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id=change_date_icon onclick="modifierDate()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000" style="margin-left: 10px;">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
        </div>
        <br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman"><span size="3" style="padding-left:100px; margin-right:5px">SCORE :
                </font>
            </strong>
            <?php echo '<div  style="display:inline-block; margin-right:10px;">'.$_SESSION['utilisateur']['score_utilisateur'].'</div>';?>
        </div>
        <br /><br />
        <strong>
            <font face="Times New Roman" size="5" style="padding-left:50px">Identifications : </font>
        </strong>
        <br /><br />
        <div style="display: flex; align-items: center;">
            <strong>
                <font face="Times New Roman">
                    <span size="3" style="padding-left: 100px; margin-right: 5px">ADRESSE MAIL :</span>
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php echo '<div id="texteMail" style="margin-right: 5px;">'.$_SESSION['utilisateur']['email'].'</div>';?>
                <input type="text" name="champMail" id="champMail" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id="change_mail_icon" onclick="modifierMail()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
        </div>


        <br />
        <div style="display: flex; align-items: center; margin-bottom: 20px;">
            <strong>
                <font face="Times New Roman"><span size="3" ; style="padding-left:100px; margin-right:5px;">MOT DE PASSE
                        :
                </font>
            </strong>
            <div style="display: flex; flex-direction: column; align-items: flex-start;">
                <?php 
                $motDePasse = $_SESSION['utilisateur']['mot_de_passe'];
                $longueurMotDePasse = strlen($motDePasse);
                $motDePasseCache = str_repeat('*', $longueurMotDePasse);
                echo '<div  id="texteMdp" style="display:inline-block; margin-right:5px;">'.$motDePasseCache.'</div>';?>
                <input type="text" name="champMdp" id="champMdp" placeholder="Entrez une valeur"
                    style="display: none; font-size: 15px; margin-right: 5px;" required>
            </div>
            <svg id=change_mdp_icon onclick="modifierMdp()" xmlns="http://www.w3.org/2000/svg" height="20px"
                viewBox="0 0 24 24" width="20px" fill="#000000">
                <path d="M0 0h24v24H0z" fill="none" />
                <path
                    d="M3 17.25V21h3.75L17.81 9.94l-3.75-3.75L3 17.25zM20.71 7.04c.39-.39.39-1.02 0-1.41l-2.34-2.34c-.39-.39-1.02-.39-1.41 0l-1.83 1.83 3.75 3.75 1.83-1.83z" />
            </svg>
            <br />
        </div>


    </div>

</body>

<link href="CSS/style_toast.css" rel="stylesheet" type="text/css">
<script src="Toasts.js"></script>
<script>
// Fonction pour afficher le toast
function afficherToastSuccess(type) {
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
    if (type === "nom") {
        toasts.push({
            title: 'Compte',
            content: 'Votre nom a bien été mis à jour',
            style: 'success'
        });
    } else if (type === "prenom") {
        toasts.push({
            title: 'Compte',
            content: 'Votre prenom a bien été mis à jour',
            style: 'success'
        });
    } else if (type === "age") {
        toasts.push({
            title: 'Compte',
            content: 'Votre age a bien été mis à jour',
            style: 'success'
        });
    }
    if (type === "date") {
        toasts.push({
            title: 'Compte',
            content: 'Votre date de naissance a bien été mis à jour',
            style: 'success'
        });
    } else if (type === "mail") {
        toasts.push({
            title: 'Compte',
            content: 'Votre email a bien été mis à jour',
            style: 'success'
        });
    } else if (type === "mdp") {
        toasts.push({
            title: 'Compte',
            content: 'Votre mot de passe a bien été mis à jour. ATTENTION il faut recharger la page pour pouvoir avoir la mise à jour si vous voulez remodifier votre mot de passe. ',
            style: 'success'
        });

    }
}

// Fonction pour afficher le toast
function afficherToastError(type) {
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
    if (type === "nom") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre nom',
            style: 'error'
        });
    } else if (type === "prenom") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre prenom',
            style: 'error'
        });
    } else if (type === "age") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre age',
            style: 'error'
        });
    }
    if (type === "date") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre date de naissance',
            style: 'error'
        });
    } else if (type === "mail") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre email',
            style: 'error'
        });
    } else if (type === "mdp") {
        toasts.push({
            title: 'Compte',
            content: 'Il y a eu une erreur lors de la mise à jour de votre mot de passe',
            style: 'error'
        });

    }
}
</script>

</html>
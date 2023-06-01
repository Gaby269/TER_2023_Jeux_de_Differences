<?php
    session_start();

if (isset($_POST['mdp'])){
    $mdp = $_POST['mdp'];
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierMdp = "UPDATE utilisateur SET mot_de_passe = :valeur WHERE id_utilisateur = :idU;";
    //execution
    //echo $modifierMdp;
    $modifier_mdp = $dbh->prepare($modifierMdp);
    $modifier_mdp->bindParam(':valeur', $mdp);
    $modifier_mdp->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_mdp->execute();
    if (!$modifier_mdp){
        echo "impossible";
    }
    else{
        echo "update";
        $_SESSION['utilisateur']['mot_de_passe'] = $mdp;

    }
    
}

if (isset($_GET['prenom'])){
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierPrenom = "UPDATE utilisateur SET prenom = :valeur WHERE id_utilisateur = :idU;";
    //execution
    //echo $modifierPrenom;
    $modifier_prenom = $dbh->prepare($modifierPrenom);
    $modifier_prenom->bindParam(':valeur', $_GET['prenom']);
    $modifier_prenom->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_prenom->execute();
    if (!$modifier_prenom){
        echo "impossible";
    }
    else{
        echo "update";
        $_SESSION['utilisateur']['prenom'] = $_GET['prenom'];

    }
}

if (isset($_GET['nom'])) {
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierNom = "UPDATE utilisateur SET nom = :valeur WHERE id_utilisateur = :idU;";
    // Execution de la requête
    $modifier_nom = $dbh->prepare($modifierNom);
    $modifier_nom->bindParam(':valeur', $_GET['nom']);
    $modifier_nom->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_nom->execute();
    if (!$modifier_nom) {
        echo "impossible";
    } else {
        echo "update";
        $_SESSION['utilisateur']['nom'] = $_GET['nom'];

    }
}


if (isset($_GET['mail'])){
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierMail = "UPDATE utilisateur SET email = :valeur WHERE id_utilisateur = :idU;";
    //execution
    //echo $modifierMail;
    $modifier_mail = $dbh->prepare($modifierMail);
    $modifier_mail->bindParam(':valeur', $_GET['mail']);
    $modifier_mail->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_mail->execute();
    if (!$modifier_mail){
        echo "impossible";
    }
    else{
        echo "update";
        $_SESSION['utilisateur']['email'] = $_GET['mail'];

    }
}

if (isset($_GET['date'])){
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierDate = "UPDATE utilisateur SET date_naissance = :valeur WHERE id_utilisateur = :idU;";
    //execution
    //echo $modifierDate;
    $modifier_date = $dbh->prepare($modifierDate);
    $modifier_date->bindParam(':valeur', $_GET['date']);
    $modifier_date->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_date->execute();
    if (!$modifier_date){
        echo "impossible";
    }
    else{
        echo "update";
        $_SESSION['utilisateur']['date_naissance'] = $_GET['date'];

    }
}


if (isset($_GET['age'])){
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");
        
    $modifierAge = "UPDATE utilisateur SET age = :valeur WHERE id_utilisateur = :idU;";
    //execution
    //echo $modifierAge;
    $modifier_age = $dbh->prepare($modifierAge);
    $modifier_age->bindParam(':valeur', $_GET['age']);
    $modifier_age->bindParam(':idU', $_SESSION['utilisateur']['id_utilisateur']);
    $modifier_age->execute();
    if (!$modifier_age){
        echo "impossible";
    }
    else{
        echo "update";
        $_SESSION['utilisateur']['age'] = $_GET['age'];

    }
}



?>
<?php
session_start();

if (isset($_GET['email']) && isset($_GET['password'])) {

    $email = $_GET['email'];
    $mdp = $_GET['password'];

    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");

    $stmt = $dbh->prepare("SELECT * FROM utilisateur WHERE email = '$email' AND mot_de_passe = '$mdp';");
    $stmt->execute();
    $result = $stmt->fetch(PDO::FETCH_ASSOC);
    
    $_SESSION['utilisateur'] = $result;
    
    if ($_SESSION['utilisateur']['email'] == $email && $_SESSION['utilisateur']['mot_de_passe'] == $mdp) {
        echo $_SESSION['utilisateur']['id_utilisateur'];
    } else {
        echo "";
    }
}
?>
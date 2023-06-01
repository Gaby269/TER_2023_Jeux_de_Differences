<?php 

if (isset($_GET['email'])) {

    $email = $_GET['email'];

    

    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");

    $stmt = $dbh->prepare('SELECT COUNT(*) FROM utilisateur WHERE email = "'.$email.'";');
    $stmt->execute();
    $result = $stmt->fetchColumn();
    if ($result == 0) {
        echo 'not';
    } else {
        echo 'exists';
    }
}
?>
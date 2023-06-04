<?php 

if (isset($_GET['id'])) {

    $idDiff = $_GET['id'];
    echo $idDiff;
    
    //$dsn="mysql:host=localhost;dbname=ter_2023_differences";
    $dsn = "mysql:host=localhost;dbname=id20747577_ter_2023_differences";
    //$username="root";
    $username = "id20747577_root"; 
    //$password="";
    $password = "0109LeoGaby*";
    $options=array(PDO::MYSQL_ATTR_INIT_COMMAND=> 'SET NAMES utf8');
    $dbh=new PDO($dsn, $username, $password, $options) or die("Pb de connexion !");


    $query = "DELETE FROM difference_partie WHERE idDifference = :idD;";
    $statement = $dbh->prepare($query);
    $statement->bindParam(':idD', $idDiff);
    $statement->execute();
    
    if ($statement->rowCount() > 0) {
        $query = "DELETE FROM differences WHERE id_difference = :idD;";
        $statement = $dbh->prepare($query);
        $statement->bindParam(':idD', $idDiff);
        $statement->execute();
        
        if ($statement->rowCount() > 0) {
            echo 'delete';
        } else {
            echo 'noooo';
        }
    }
    else{
        echo 'noooo';
    }
}
?>
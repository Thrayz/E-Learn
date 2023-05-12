<?php
try {

    $pdo = new PDO("mysql:host=localhost;dbname=elearn",
        "root", "");

}catch (Exception $e){
    
 
                    
    die('Erreur : impossible de se connecter à la base de donnée');
}
?>


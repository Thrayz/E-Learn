<?php
session_start();
if(isset($_SESSION['user']) ){



        require_once('connexiondb.php');

        $idcours = isset($_GET['idCours']) ? $_GET['idCours'] : null;


        $requete="delete from abonnement where idcours=?";

        $params=array($idcours);

        $resultat=$pdo->prepare($requete);

        $resultat->execute($params);





}else {
    header('location:login.php');
}

header('location:abonnements.php');
?>
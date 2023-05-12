<?php
require_once('identifier.php');
require_once('connexiondb.php');

$idUser = $_SESSION['user']['iduser'];
$idcours = isset($_GET['idCours']) ? $_GET['idCours'] : null;




$requete="insert into Abonnement(idUser,idcours) values(?,?)";
$params=array($idUser,$idcours);
$resultat=$pdo->prepare($requete);
$resultat->execute($params);

header('location:Cours.php');

?>
<?php

ob_start();
require_once('identifier.php');

require_once('connexiondb.php');

$idcours=isset($_POST['idCours'])?$_POST['idCours']:0;

$titre=isset($_POST['titre'])?$_POST['titre']:"";

$video=isset($_POST['video'])?($_POST['video']):"";

$description=isset($_POST['Description'])?($_POST['Description']):"";
$requete = "UPDATE cours SET titre=?, video=?, description=? WHERE idcours=?";
$params = array($titre, $video, $description, $idcours);

$resultat=$pdo->prepare($requete);

$resultat->execute($params);

header('location:cours.php');
exit();
ob_end_flush();
?>

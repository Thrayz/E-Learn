<?php
require_once('identifier.php');
require_once('connexiondb.php');
$titre=isset($_POST['titre'])?$_POST['titre']:"";
$description=isset($_POST['description'])?$_POST['description']:"";
$idUser=isset($_POST['idUser'])?$_POST['idUser']:1;
$idFiliere=isset($_POST['idFiliere'])?$_POST['idFiliere']:1;
$idUser = $_SESSION['user']['iduser'];
$nomPhoto=isset($_FILES['video']['name'])?$_FILES['video']['name']:1;
$imageTemp=$_FILES['video']['tmp_name'];
move_uploaded_file($imageTemp,"../images/".$nomPhoto);


$requete="insert into cours(titre,video,description,idFiliere,idUser) values(?,?,?,?,?)";
$params=array($titre,$nomPhoto,$description,$idFiliere,$idUser);
echo"$requete";
$resultat=$pdo->prepare($requete);
$resultat->execute($params);

header('location:Cours.php');

?>
<?php
session_start();
if(isset($_SESSION['user']) ){



    if($_SESSION['user']['role']=='ADMIN'){

        require_once('connexiondb.php');

        $idS=isset($_GET['idS'])?$_GET['idS']:0;

        $requete="delete from cours where idCours=?";

        $params=array($idS);

        $resultat=$pdo->prepare($requete);

        $resultat->execute($params);

        header('location:Cours.php');

    }else{
        $message="Vous n'avez pas le privilège de supprimer un Cours!!!";

        $url='Cours.php';

        header("location:alerte.php?message=$message&url=$url");
    }

}else {
    header('location:login.php');
}
?>
<?php
    session_start();
        if(isset($_SESSION['user'])){
            
            require_once('connexiondb.php');
            $idf=isset($_GET['idF'])?$_GET['idF']:0;

            $requeteEt="select count(*) countEt from etudiant where idFiliere=$idf";
            $resultatEt=$pdo->query($requeteEt);
            $tabCountEt=$resultatEt->fetch();
            $nbrStag=$tabCountEt['countEt'];
            
            if($nbrStag==0){
                $requete="delete from filiere where idFiliere=?";
                $params=array($idf);
                $resultat=$pdo->prepare($requete);
                $resultat->execute($params);
                header('location:filieres.php');
            }else{
                $msg="Suppression impossible: Vous devez supprimer tous les etudiants inscris dans cette filière";
                header("location:alerte.php?message=$msg");
            }
            
         }else {
                header('location:login.php');
        }
    
    
    
    
?>
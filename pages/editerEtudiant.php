<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
    $idS=isset($_GET['idS'])?$_GET['idS']:0;
    $requeteS="select * from Etudiant where idEtudiant=$idS";
    $resultatS=$pdo->query($requeteS);
    $Etudiant=$resultatS->fetch();
    $nom=$Etudiant['nom'];
    $prenom=$Etudiant['prenom'];
    $civilite=strtoupper($Etudiant['civilite']);
    $idFiliere=$Etudiant['idFiliere'];
    $nomPhoto=$Etudiant['photo'];

    $requeteF="select * from filiere";
    $resultatF=$pdo->query($requeteF);

?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'un Etudiant</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition du Etudiant :</div>
                <div class="panel-body">
                    <form method="post" action="updateEtudiant.php" class="form"  enctype="multipart/form-data">
						<div class="form-group">
                             <label for="idS">id du Etudiant: <?php echo $idS ?></label>
                            <input type="hidden" name="idS" class="form-control" value="<?php echo $idS ?>"/>
                        </div>
                        <div class="form-group">
                             <label for="nom">Nom :</label>
                            <input type="text" name="nom" placeholder="Nom" class="form-control" value="<?php echo $nom ?>"/>
                        </div>
                        <div class="form-group">
                             <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" placeholder="Prénom" class="form-control"
                                   value="<?php echo $prenom ?>"/>
                        </div>
                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                            <div class="radio">
                                <label><input type="radio" name="civilite" value="Femme"
                                    <?php if($civilite==="Femme")echo "checked" ?> /> Femme </label><br>
                                <label><input type="radio" name="civilite" value="Homme"
                                    <?php if($civilite==="Homme")echo "checked" ?> checked/> Homme </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idFiliere">Filière:</label>
				            <select name="idFiliere" class="form-control" id="idFiliere">
                              <?php while($filiere=$resultatF->fetch()) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>"
                                         <?php if($idFiliere===$filiere['idFiliere']) echo "selected" ?>> 
                                    <?php echo $filiere['nomFiliere'] ?>
                                </option>
                              <?php }?>
				            </select>
                        </div>
                        <div class="form-group">
                             <label for="photo">Photo :</label>
                            <input type="file" name="photo" />
                        </div>

				        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-save"></span>
                            &nbsp  Modifier
                        </button> 
                      
					</form>
                </div>
            </div>   
        </div>      
    </body>
</HTML>
<?php
    require_once('identifier.php');
    require_once('connexiondb.php');
   
    $requeteF="select * from filiere";
    $resultatF=$pdo->query($requeteF);

?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Nouveau Etudiant</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Les données du nouveau Etudiant :</div>
                <div class="panel-body">
                    <form method="post" action="insertEtudiant.php" class="form"  enctype="multipart/form-data">
						
                        <div class="form-group">
                             <label for="nom">Nom :</label>
                            <input type="text" name="nom" placeholder="Nom" class="form-control"/>
                        </div>
                        <div class="form-group">
                             <label for="prenom">Prénom :</label>
                            <input type="text" name="prenom" placeholder="Prénom" class="form-control"/>
                        </div>
                        <div class="form-group">
                            <label for="civilite">Civilité :</label>
                            <div class="radio">
                                <label><input type="radio" name="civilite" value="Femme" /> Femme </label><br>
                                <label><input type="radio" name="civilite" value="Homme" checked /> Homme </label>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="idFiliere">Filière:</label>
				            <select name="idFiliere" class="form-control" id="idFiliere">
                              <?php while($filiere=$resultatF->fetch()) { ?>
                                <option value="<?php echo $filiere['idFiliere'] ?>">
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
                            Ajouter
                        </button> 
                      
                        <p class="text-right">
                   
                   <a href="cours.php">Précedent</a>
               </p>
                      
                      
					</form>
                </div>
            </div>   
        </div>      
    </body>
</HTML>
<?php
   require_once('identifier.php');
    require_once('connexiondb.php');
    $idf=isset($_GET['idF'])?$_GET['idF']:0;
    $requete="select * from filiere where idFiliere=$idf";
    $resultat=$pdo->query($requete);
    $filiere=$resultat->fetch();
    $nomf=$filiere['nomFiliere'];
    $niveau=strtolower($filiere['niveau']);
?>
<! DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Edition d'une filière</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Edition de la filière :</div>
                <div class="panel-body">
                    <form method="post" action="updateFiliere.php" class="form">
						<div class="form-group">
                             <label for="niveau">id de la filière: <?php echo $idf ?></label>
                            <input type="hidden" name="idF" 
                                   class="form-control"
                                    value="<?php echo $idf ?>"/>
                        </div>
                        
                        <div class="form-group">
                             <label for="niveau">Nom de la filière:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"
                                   value="<?php echo $nomf ?>"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
				            <select name="niveau" class="form-control" id="niveau">
                                
                                <option value="Technicien" <?php if($niveau=="Technicien") echo "selected" ?>>Technicien</option>
                                <option value="Technicien Spécialisé"<?php if($niveau=="Technicien Spécialisé") echo "selected" ?>>Technicien Spécialisé</option>
                                <option value="Licence" <?php if($niveau=="Licence") echo "selected" ?>>Licence</option>
                                <option value="Master" <?php if($niveau=="Master") echo "selected" ?>>Master</option>
                                <option value="Ingenierie" <?php if($niveau=="Ingenierie") echo "selected" ?>>Ingenierie
                                </option>
				            </select>
                        </div>
                        
				        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-save"></span>
                            &nbsp Modifier
                        </button> 
                      
					</form>
                </div>
            </div>   
        </div>      
    </body>
</HTML>
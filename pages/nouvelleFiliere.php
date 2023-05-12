<?php 
    require_once('identifier.php');
?>

<HTML>
    <head>
        <meta charset="utf-8">
        <tit>Nouvelle filière</tit>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php include("menu.php"); ?>
        
        <div class="container">
                       
             <div class="panel panel-primary margetop60">
                <div class="panel-heading">Veuillez saisir les données de la nouvelle filière</div>
                <div class="panel-body">
                    <form method="post" action="insertFiliere.php" class="form">
						
                        <div class="form-group">
                             <label for="niveau">Nom de la filière:</label>
                            <input type="text" name="nomF" 
                                   placeholder="Nom de la filière"
                                   class="form-control"/>
                        </div>
                        
                        <div class="form-group">
                            <label for="niveau">Niveau:</label>
				            <select name="niveau" class="form-control" id="niveau">
                                <option value="Technicien">Technicien</option>
                                <option value="Technicien Specialise" >Technicien Spécialisé</option>
                                <option value="Licence" selected>Licence</option>
                                <option value="Master">Master</option>
                                <option value="Master">Ingenierie
                                </option>
                            </select>
                        </div>
                        
				        <button type="submit" class="btn btn-primary">
                            <span class="glyphicon glyphicon-save"></span>
                            Ajouter
                        </button> 
                        <p class="text-right">
                   
                   <a href="filieres.php">Précedent</a>
               </p>
					</form>
                </div>
            </div>
            
        </div>      
    </body>
</HTML>
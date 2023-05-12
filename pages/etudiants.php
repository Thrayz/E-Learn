<?php
    require_once('identifier.php');
    
    require_once("connexiondb.php");
  
    $nomPrenom=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idfiliere=isset($_GET['idfiliere'])?$_GET['idfiliere']:0;
    
    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    $requeteFiliere="select * from filiere";

    if($idfiliere==0){
        $requeteEtudiant="select idEtudiant,nom,prenom,nomFiliere,photo,civilite 
                from filiere as f,Etudiant as s
                where f.idFiliere=s.idFiliere
                and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                order by idEtudiant
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from Etudiant
                where nom like '%$nomPrenom%' or prenom like '%$nomPrenom%'";
    }else{
         $requeteEtudiant="select idEtudiant,nom,prenom,nomFiliere,photo,civilite 
                from filiere as f,Etudiant as s
                where f.idFiliere=s.idFiliere
                and (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                and f.idFiliere=$idfiliere
                 order by idEtudiant
                limit $size
                offset $offset";
        
        $requeteCount="select count(*) countS from Etudiant
                where (nom like '%$nomPrenom%' or prenom like '%$nomPrenom%')
                and idFiliere=$idfiliere";
    }

    $resultatFiliere=$pdo->query($requeteFiliere);
    $resultatEtudiant=$pdo->query($requeteEtudiant);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrEtudiant=$tabCount['countS'];
    $reste=$nbrEtudiant % $size;   
    if($reste===0) 
        $nbrPage=$nbrEtudiant/$size;   
    else
        $nbrPage=floor($nbrEtudiant/$size)+1;  
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>E-Learn</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php require("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-success margetop60">
            
				<div class="panel-heading">Rechercher des Etudiants</div>
				
				<div class="panel-body">
					<form method="get" action="Etudiants.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="nomPrenom" 
                                   placeholder="Nom et prénom"
                                   class="form-control"
                                   value="<?php echo $nomPrenom ?>"/>
                        </div>
                            <label for="idfiliere">Filière:</label>
                            
				            <select name="idfiliere" class="form-control" id="idfiliere"
                                    onchange="this.form.submit()">
                                    
                                    <option value=0>Toutes les filières</option>
                                    
                                <?php while ($filiere=$resultatFiliere->fetch()) { ?>
                                
                                    <option value="<?php echo $filiere['idFiliere'] ?>"
                                    
                                        <?php if($filiere['idFiliere']===$idfiliere) echo "selected" ?>>
                                        
                                        <?php echo $filiere['nomFiliere'] ?> 
                                        
                                    </option>
                                    
                                <?php } ?>
                                
				            </select>
				            
				        <button type="submit" class="btn btn-primary">
                                <span class="glyphicon glyphicon-search"></span>
                            Chercher
                        </button> 
                        
                        &nbsp;&nbsp;
                         <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                         
                            <a href="nouveauEtudiant.php">
                            
                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Etudiant
                                
                            </a>
                            
                         <?php }?>
					</form>
				</div>
			</div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des Etudiants (<?php echo $nbrEtudiant ?> Etudiants)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id Etudiant</th> <th>Nom</th> <th>Prénom</th> 
                                <th>Filière</th><th>Civilité</th> <th>Photo</th> 
                                <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                	<th>Actions</th>
                                <?php }?>
                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($Etudiant=$resultatEtudiant->fetch()){ ?>
                                <tr>
                                    <td><?php echo $Etudiant['idEtudiant'] ?> </td>
                                    <td><?php echo $Etudiant['nom'] ?> </td>
                                    <td><?php echo $Etudiant['prenom'] ?> </td> 
                                    <td><?php echo $Etudiant['nomFiliere'] ?> </td>
                                    <td><?php echo $Etudiant['civilite'] ?> </td>
                                    <td>
                                        <img src="../images/<?php echo $Etudiant['photo']?>"
                                        width="50px" height="50px" class="img-circle">
                                    </td> 
                                    
                                     <?php if ($_SESSION['user']['role']== 'ADMIN') {?>
                                        <td>
                                            <a href="editerEtudiant.php?idS=<?php echo $Etudiant['idEtudiant'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                                <span >Modifier </span>
                                            </a>
                                            &nbsp;&nbsp;
                                            <a onclick="return confirm('Etes vous sur de vouloir supprimer le Etudiant')"
                                            href="supprimerEtudiant.php?idS=<?php echo $Etudiant['idEtudiant'] ?>">
                                               <span class="glyphicon glyphicon-trash"></span>
                                               <span >Supprimer</span>
                                            </a>
                                        </td>
                                    <?php }?>
                                    
                                 </tr>
                             <?php } ?>
                        </tbody>
                    </table>
                <div>
                    <ul class="pagination">
                        <?php for($i=1;$i<=$nbrPage;$i++){ ?>
                            <li class="<?php if($i==$page) echo 'active' ?>"> 
            <a href="Etudiants.php?page=<?php echo $i;?>&nomPrenom=<?php echo $nomPrenom ?>&idfiliere=<?php echo $idfiliere ?>">
                                    <?php echo $i; ?>
                                </a> 
                             </li>
                        <?php } ?>
                    </ul>
                </div>
                </div>
            </div>
        </div>
    </body>
</HTML>

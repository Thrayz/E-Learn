<?php
    require_once('identifier.php');
    
    require_once("connexiondb.php");
  
    $titre=isset($_GET['nomPrenom'])?$_GET['nomPrenom']:"";
    $idfiliere=isset($_GET['idfiliere'])?$_GET['idfiliere']:0;
    
    $size=isset($_GET['size'])?$_GET['size']:5;
    $page=isset($_GET['page'])?$_GET['page']:1;
    $offset=($page-1)*$size;
    
    $requeteFiliere="select * from filiere";

    if($idfiliere==0){
        $requeteCours="select s.idCours, s.titre, s.video, s.description, f.nomFiliere
            from filiere as f,cours as s
            where f.idFiliere=s.idfiliere
            and (s.titre like '%$titre%')
            order by s.idCours
            limit $size
            offset $offset";
        
        $requeteCount="select count(*) countS from cours
                where titre like '%$titre%'";
    }else{
        $requeteCours="select s.idCours, s.titre, s.video, s.description, f.nomFiliere
            from filiere as f,cours as s
            where f.idFiliere=s.idfiliere
            and f.idFiliere = $idfiliere
            and (s.titre like '%$titre%')
            order by s.idCours
            limit $size
            offset $offset";
        
        $requeteCount="select count(*) countS from cours
                where (titre like '%$titre%')
                and idFiliere=$idfiliere";
    }

    $resultatFiliere=$pdo->query($requeteFiliere);
    $resultatCours=$pdo->query($requeteCours);
    $resultatCount=$pdo->query($requeteCount);

    $tabCount=$resultatCount->fetch();
    $nbrCours=$tabCount['countS'];
    $reste=$nbrCours % $size;
    if($reste===0) 
        $nbrPage=$nbrCours/$size;
    else
        $nbrPage=floor($nbrCours/$size)+1;
?>
<!DOCTYPE HTML>
<HTML>
    <head>
        <meta charset="utf-8">
        <title>Gestion des Cours</title>
        <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
        <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
        <link rel="stylesheet" type="text/css" href="../css/Styles.css">
    </head>
    <body class="vh-100 gradient-custom">
        <?php require("menu.php"); ?>
        
        <div class="container">
            <div class="panel panel-success margetop60">
            
				<div class="panel-heading">Rechercher des Cours</div>
				
				<div class="panel-body">
					<form method="get" action="cours.php" class="form-inline">
						<div class="form-group">
						
                            <input type="text" name="titre"
                                   placeholder="titre de cours"
                                   class="form-control"
                                   value="<?php echo $titre ?>"/>
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
                        
                        &nbsp;&nbsp;  <?php if ($_SESSION['user']['role']== 'ADMIN' or $_SESSION['user']['role']== 'Prof') {?>

                            <a href="nouveauCours.php">

                                <span class="glyphicon glyphicon-plus"></span>
                                Nouveau Cours

                            </a>

                        <?php }?>

					</form>
				</div>
			</div>
            
            <div class="panel panel-primary">
                <div class="panel-heading">Liste des Cours (<?php echo $nbrCours ?> Cours)</div>
                <div class="panel-body">
                    <table class="table table-striped table-bordered">
                        <thead>
                            <tr>
                                <th>Id Cours</th> <th>titre</th> <th>video</th>
                                <th>Filière</th><th>description</th>

                            </tr>
                        </thead>
                        
                        <tbody>
                            <?php while($Cours=$resultatCours->fetch()){ ?>
                                <tr>
                                    <td><?php echo $Cours['idCours'] ?> </td>
                                    <td><?php echo $Cours['titre'] ?> </td>
                                    <td>
                                        <img src="../images/<?php echo $Cours['video']?>"
                                             width="100px" height="100px" >
                                    </td>
                                    <td><?php echo $Cours['nomFiliere'] ?> </td>
                                    <td><?php echo $Cours['description'] ?> </td>
                                    </td>

                                    <?php if ($_SESSION['user']['role']== 'ADMIN' or $_SESSION['user']['role']== 'Prof') {?>
                                    <td>
                                        <a href="editerCours.php?idCours=<?php echo $Cours['idCours'] ?>">
                                            <span class="glyphicon glyphicon-edit"></span>
                                            <span >Modifier </span>
                                        </a>
                                        &nbsp;&nbsp;
                                        <a onclick="return confirm('Etes vous sur de vouloir supprimer le Cours')"
                                           href="supprimerCours.php?idCours=<?php echo $Cours['idCours'] ?>">
                                            <span class="glyphicon glyphicon-trash"></span>
                                            <span >Supprimer</span>
                                        </a>
                                    </td>
                                    <?php }?>
                                    <?php if ($_SESSION['user']['role']== 'Etudiant') {?>
                                        <td>
                                            <a href="insertabonnement.php?idCours=<?php echo $Cours['idCours'] ?>">
                                                <span class="glyphicon glyphicon-edit"></span>
                                                <span >Abonner </span>
                                            </a>
                                            &nbsp;&nbsp;

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
            <a href="Cours.php?page=<?php echo $i;?>&titre=<?php echo $titre ?>&idfiliere=<?php echo $idfiliere ?>">
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

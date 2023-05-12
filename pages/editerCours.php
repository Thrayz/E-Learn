<?php
require_once('identifier.php');
require_once('connexiondb.php');
$idCours=isset($_GET['idCours'])?$_GET['idCours']:0;
$requeteS="select * from Cours where idCours=$idCours";
$resultatS=$pdo->query($requeteS);
$Cours=$resultatS->fetch();
$titre=$Cours['titre'];
$video=$Cours['video'];
$Description=$Cours['description'];
$idFiliere=$Cours['idfiliere'];

$requeteF="select * from filiere";
$resultatF=$pdo->query($requeteF);

?>
<! DOCTYPE HTML>
<HTML>
<head>
    <meta charset="utf-8">
    <title>Edition d'un Cours</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Styles.css">
</head>
<body class="vh-100 gradient-custom">
<?php include("menu.php"); ?>

<div class="container">

    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Edition du cours :</div>
        <div class="panel-body">
            <form method="post" action="updateCours.php" class="form"  enctype="multipart/form-data">
                <div class="form-group">
                    <label for="idcours">id du cours: <?php echo $idCours ?></label>
                    <input type="hidden" name="idcours" class="form-control" value="<?php echo $idCours ?>"/>
                </div>
                <div class="form-group">
                    <label for="nom">Titre :</label>
                    <input type="text" name="titre" placeholder="titre" class="form-control" value="<?php echo $titre ?>"/>
                </div>
                <div class="form-group">
                    <label for="photo">Video :</label>
                    <input type="file" name="Video" />
                </div>
                <div class="form-group">
                    <label for="prenom">Description :</label>
                    <input type="text" name="Description" placeholder="Description" class="form-control"
                           value="<?php echo $Description ?>"/>
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
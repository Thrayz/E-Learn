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
        <div class="panel-heading">Les données du nouveau Cours :</div>
        <div class="panel-body">
            <form method="post" action="insertCours.php" class="form"  enctype="multipart/form-data">

                <div class="form-group">
                    <label for="titre">titre :</label>
                    <input type="text" name="titre" placeholder="titre" class="form-control"/>
                </div>
                <div class="form-group">
                    <label for="description">description :</label>
                    <input type="text" name="description" placeholder="description" class="form-control"/>
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
                    <label for="photo">video :</label>
                    <input type="file" name="video" />
                </div>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-save"></span>
                    Ajouter
                </button>

                <p class="text-right">

                    <a href="Cours.php">Précedent</a>
                </p>


            </form>
        </div>
    </div>
</div>
</body>
</HTML>
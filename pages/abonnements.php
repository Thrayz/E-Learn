<?php
require_once('identifier.php');

require_once("connexiondb.php");




$size=isset($_GET['size'])?$_GET['size']:5;
$page=isset($_GET['page'])?$_GET['page']:1;
$offset=($page-1)*$size;
$idUser = $_SESSION['user']['iduser'];




    $requeteCours="SELECT c.* FROM abonnement a 
    JOIN utilisateur e ON a.iduser = e.iduser 
    JOIN cours c ON a.idcours = c.idCours 
           where e.iduser = $idUser
           order by c.idCours
            limit $size
            offset $offset";

    $requeteCount="SELECT COUNT(*) AS total_abonnements FROM abonnement a 
    JOIN utilisateur e ON a.iduser = e.iduser 
    JOIN cours c ON a.idcours = c.idcours
    where e.iduser = $idUser;";



$resultatCours=$pdo->query($requeteCours);
$resultatCount=$pdo->query($requeteCount);

$tabCount=$resultatCount->fetch();
$nbrCours=$tabCount['total_abonnements'];

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
    <title>Gestion des abonnements</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Styles.css">
</head>
<body class="vh-100 gradient-custom">
<?php require("menu.php"); ?>


<br>
<br>
<br>
<br>
<br>
<br>
<div class="container">

    <div class="panel panel-primary">
        <div class="panel-heading">Liste des Cours (<?php echo $nbrCours ?> Cours)</div>
        <div class="panel-body">
            <table class="table table-striped table-bordered">
                <thead>
                <tr>
                    <th>Id Cours</th> <th>titre</th> <th>video</th>
                   <th>description</th><th>Actions</th>

                </tr>
                </thead>

                <tbody>
                <?php while($Cours=$resultatCours->fetch()){ ?>
                    <tr>
                        <td><?php echo $Cours['idCours'] ?> </td>
                        <td><?php echo $Cours['titre'] ?> </td>
                        <td><?php echo $Cours['video'] ?> </td>

                        <td><?php echo $Cours['description'] ?> </td>
                        <?php if ($_SESSION['user']['role']== 'Etudiant') {?>
                            <td>

                                &nbsp;&nbsp;
                                <a onclick="return confirm('Etes vous sur de vouloir disabonner de ce cours')"
                                   href="disabonner.php?idCours=<?php echo $Cours['idCours'] ?>">
                                    <span class="glyphicon glyphicon-trash"></span>
                                    <span >Disabonner</span>
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
                            <a href="abonnements.php?page=<?php echo $i;?>">
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


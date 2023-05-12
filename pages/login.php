<?php
session_start();
if (isset($_SESSION['erreurLogin']))
    $erreurLogin = $_SESSION['erreurLogin'];
else {
    $erreurLogin = "";
}
session_destroy();
?>

<HTML>
<head>
    <meta charset="utf-8">
    <title>Se connecter</title>
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
    <link rel="stylesheet" type="text/css" href="../css/font-awesome.min.css">
    <link rel="stylesheet" type="text/css" href="../css/Styles.css">
</head>
<body class="vh-100 gradient-custom">
<div class="container col-md-6 col-md-offset-3 col-lg-4 col-lg-offset-4">
    <div class="panel panel-primary margetop60">
        <div class="panel-heading">Se connecter :</div>
        <div class="panel-body">
            <form method="post" action="seConnecter.php" class="form">

                <?php if (!empty($erreurLogin)) { ?>
                    <div class="alert alert-danger">
                        <?php echo $erreurLogin ?>
                    </div>
                <?php } ?>

                <div class="form-group">
                    <label for="login">Nom d'utilisateur :</label>
                    <input type="text" name="login" placeholder="Nom d'utilisateur"
                           class="form-control" autocomplete="off"/>
                </div>
                        
                <div class="form-group">
                    <label for="pwd">Mot de passe :</label>
                    <input type="password" name="pwd"
                           placeholder="Mot de passe" class="form-control"/>
                </div>

                <button type="submit" class="btn btn-primary">
                    <span class="glyphicon glyphicon-log-in"></span>
                   &nbsp  Se connecter
                </button>
                <p class="text-right">
                   
                    <a href="nouvEtudiant.php">Créer un compte</a>
                </p>
            </form>
        </div>
    </div>
</div>
</body>
</HTML>

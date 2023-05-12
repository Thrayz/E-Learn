<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

<nav class="navbar navbar-inverse navbar-fixed-top">

	<div class="container-fluid">
	
		<div class="navbar-header">
		
			<a href="../index.php" class="navbar-brand">E-Learn</a>
			
		</div>
		
		<ul class="nav navbar-nav">
            <?php if ($_SESSION['user']['role']=='ADMIN') {?>
			<li><a href="etudiants.php">
                    <i class="fa fa-vcard"></i>
                    &nbsp Les Etudiant
                </a>
            </li>
            <?php }?>
            <li><a href="cours.php">
                    <i class="fa fa-vcard"></i>
                    &nbsp Les cours
                </a>
            </li>

            <?php if ($_SESSION['user']['role']=='ADMIN') {?>
			<li><a href="filieres.php">
                    <i class="fa fa-tags"></i>
                    &nbsp Les Filières
                </a>
            </li>
            <?php }?>
			<?php if ($_SESSION['user']['role']=='ADMIN') {?>
					
				<li><a href="Utilisateurs.php">
                        <i class="fa fa-users"></i>
                        &nbsp Les Utilisateurs
                    </a>
                </li>
				
			<?php }?>

            <?php if ($_SESSION['user']['role']=='Etudiant') {?>

                <li><a href="abonnements.php">
                        <i class="fa fa-graduation-cap"></i>
                        &nbsp Mes abonnements
                    </a>
                </li>

            <?php }?>
			
		</ul>
		
		
		<ul class="nav navbar-nav navbar-right">
					
			
			
			<li>
				<a href="seDeconnecter.php">
                    <i class="fa fa-sign-out"></i>
					&nbsp Se déconnecter
				</a>
			</li>
							
		</ul>
		
	</div>
</nav>

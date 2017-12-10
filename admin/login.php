<?php require 'connexion.php'; ?>
<?php

session_start();//à mettre dans toutes les pages de l'admin (même cette page)
	$msg_authentification_err='';//on initialise la variable en cas d'erreur

if(isset($_POST['connexion'])){//on envoie le form avec le name du button (on a cliqué dessus)
	$email = addslashes($_POST['email']);
	$mdp = addslashes($_POST['mdp']);
		$sql = $pdoCV->prepare(" SELECT * FROM t_utilisateurs WHERE email='$email' AND mdp='$mdp' ");// on vérifie courriel ET mot de passe
		$sql->execute();
		$nbr_utilisateur = $sql->rowCount();//on compte s'il est dans la table, le compte répond 1 s'il y est, 0 s'il n'y est pas 
			if($nbr_utilisateur==0){//il n'y est pas ! c'est la faute à sarah
				$msg_authentification_err="Erreur d'authentification !";
			}else{//on le trouve, il est inscrit, grâce à hadi
				$ligne_utilisateur = $sql->fetch();//on cherche ses infos
				
				$_SESSION['connexion']='connecté';
				$_SESSION['id_utilisateur']=$ligne_utilisateur['id_utilisateur'];
				$_SESSION['prenom']=$ligne_utilisateur['prenom'];
				$_SESSION['nom']=$ligne_utilisateur['nom'];
				
				header('location: index.php');
			}//ferme le if else
}//ferme le if isset

//pour se déconnecter de l'admin à mettre dans toutes les pages ôssi
if(isset($_GET['quitter'])){//on récupère le terme quitter dans l'url 
	
	$_SESSION['connexion']='';//on vide les variables de session
	$_SESSION['id_utilisateur']='';
	$_SESSION['prenom']='';
	$_SESSION['nom']='';
		unset($_SESSION['connexion']);
		session_destroy();
	header('location:../index.php');	
}//ferme le if isset de la déconnexion

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Authentification : admin</title>
	<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!--Mes styles-->
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<div class="container">
	  <div class="row text-left">
		  
		  <div class="col-md-1 col-lg-3">&nbsp;autre col</div>
	    <div class="col-md-6 text-center col-lg-6 col-lg-offset-0">
		    <h1>Espace administratif du site</h1>
		    <hr>
	<!--formulaire de connexion à l'admin -->
	<div class="panel panel-default">
		<div class="panel-body">
	<form action="login.php" method="post" class="form-signin">
		<div class="form-group">
		<label for="email">Courriel</label>
			<input type="email" name="email" placeholder="Votre courriel" class="form-control" required>
			<br>
		<label for="mdp">Mot de passe</label>
			<input type="password" name="mdp" placeholder="Votre mot de passe" class="form-control" required>
			<br>
		<button name="connexion" type="submit">Connexion à votre admin.</button></div>
	</form>
			</div>
		</div>
      </div><!--fermeture col-->
		  <div class="col-md-1 col-lg-3">&nbsp;autre col</div>
		</div><!--fermeture row-->
	</div> <!--fermeture container-->
	
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>
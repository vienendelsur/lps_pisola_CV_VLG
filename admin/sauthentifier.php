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

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Authentification : admin</title>
</head>
<body>
	<h1>Admin : s'authentifier</h1>
	<hr>
	<!--formulaire de connexion à l'admin -->
	<form action="sauthentifier.php" method="post" class="form-signin">
		<label for="email">Courriel</label>
			<input type="email" name="email" placeholder="Votre courriel" required>
			<br>
		<label for="mdp">Mot de passe</label>
			<input type="password" name="mdp" placeholder="Votre mot de passe" required>
			<br>
		<button name="connexion" type="submit">Connexion à votre admin.</button>
	</form>
</body>
</html>










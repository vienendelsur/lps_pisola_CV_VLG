<?php require 'admin/connexion.php'; 

session_start();// à mettre dans toutes les pages de l'admin
	if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){//on établit que la variable de session est passée et contient bien le terme "connexion" 
		$id_utilisateur=$_SESSION['id_utilisateur'];
		$prenom=$_SESSION['prenom'];		
		$nom=$_SESSION['nom'];
		
		echo $_SESSION['connexion'];		
        //var_dump($_SESSION);
	}else{//l'utilisateur n'est pas connecté
		header('location: login.php');		
}//ferme le else du if isset

//pour se déconnecter de l'admin à mettre dans toutes les pages ôssi
if(isset($_GET['quitter'])){//on récupère le terme quitter dans l'url 
	
	$_SESSION['connexion']='';//on vide les variables de session
	$_SESSION['id_utilisateur']='';
	$_SESSION['prenom']='';
	$_SESSION['nom']='';
	
		unset($_SESSION['connexion']);
		session_destroy();
	//header('location:../index.php');	
}//ferme le if isset de la déconnexion

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>Site public : Patrick Isola</title>
</head>

<body>
	<h1>Mon site public : tout est à faire</h1>
	<hr>
	<a href="admin/login.php">admin</a>
</body>
</html>

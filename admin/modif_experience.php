<?php require 'connexion.php';  

session_start();// à mettre dans toutes les pages de l'admin
	if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){//on établit que la variable de session est passée et contient bien le terme "connexion" 
		$id_utilisateur=$_SESSION['id_utilisateur'];
		$prenom=$_SESSION['prenom'];		
		$nom=$_SESSION['nom'];
		
		//echo $_SESSION['connexion'];		
        //var_dump($_SESSION);
	}else{//l'utilisateur n'est pas connecté
		header('location: login.php');		
}//ferme le else du if isset

//pour se déconnecter de l'admin à mettre dans toutes les pages ??? ou juste sur la page login.php ?
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
<?php
//mise à jour d'une compétence
if(isset($_POST['e_titre'])){//par le nom du premier input
	$e_titre = addslashes($_POST['e_titre']);
	$e_soustitre = addslashes($_POST['e_soustitre']);
	$e_dates = $_POST['e_dates']; 
	$e_description = $_POST['e_description'];
	$id_experience = $_POST['id_experience'];
	
	$pdoCV->exec(" UPDATE t_experiences SET e_titre='$e_titre', e_soustitre='$e_soustitre', e_dates='$e_dates', e_description='$e_description' WHERE id_experience='$id_experience' ");
	header('location: experiences.php');
	exit();	
}
//je récupère la réalisation
	$id_experience = $_GET['id_experience'];// par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_experiences WHERE id_experience='$id_experience' ");// la requête est égale à l'id
	$ligne_experience = $sql->fetch();
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : modification d'une expérience / <?php echo $ligne_utilisateur['pseudo']; ?></title>
</head>
<body>
	<h1>Admin du site cv de <?php echo $ligne_utilisateur['pseudo']; ?></h1>
	<p>texte</p>
	<hr>
	<h2>Modification d'une réalisation</h2>
	<form action="modif_experience.php" method="post">
		<label for="e_titre">Titre</label>
		<input type="text" name="e_titre" value="<?php echo $ligne_experience['e_titre']; ?>">
		<label for="e_soustitre">Sous-titre</label>
		<input type="text" name="e_soustitre" value="<?php echo $ligne_experience['e_soustitre']; ?>">
		<label for="e_dates">dates</label>
		<input type="text" name="e_dates" value="<?php echo $ligne_experience['e_dates']; ?>">
		<label for="e_description">Description de la réalisation</label>
		<textarea name="e_description" id="e_description" class="form-control"><?php echo $ligne_experience['e_description']; ?></textarea>
		<input hidden name="id_experience" value="<?php echo $ligne_experience['id_experience']; ?>">
		<input type="submit" value="Mettre à jour">
		
	</form>
</body>
</html>

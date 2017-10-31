<?php require 'connexion.php'; ?>
<?php
//mise à jour d'une compétence
if(isset($_POST['competence'])){//par le nom du premier input
	$competence = addslashes($_POST['competence']);
	$c_niveau = addslashes($_POST['c_niveau']);
	$id_competence = $_POST['id_competence'];
	
	$pdoCV->exec(" UPDATE t_competences SET competence='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence' ");
	header('location: competencesOLD.php');
	exit();	
}
//je récupère la réalisation
	$id_realisation = $_GET['id_realisation'];// par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_realisations WHERE id_realisation='$id_realisation' ");// la requête est égale à l'id
	$ligne_realisation = $sql->fetch();
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : modification d'une compétence / <?php echo $ligne_utilisateur['pseudo']; ?></title>
</head>
<body>
	<h1>Admin du site cv de <?php echo $ligne_utilisateur['pseudo']; ?></h1>
	<p>texte</p>
	<hr>
	<h2>Modification d'une compétence</h2>
	<p><?php echo $ligne_competence['competence']; ?></p>
	<form action="modif_competence.php" method="post">
		<label for="competence">Compétence</label>
		<input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>">
		<input type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau']; ?>">
		<input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
		<input type="submit" value="Mettre à jour">
		
	</form>
	
	
</body>
</html>

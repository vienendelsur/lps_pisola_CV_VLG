<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['competence'])) {// si on a posté une nouvelle comp.
	if($_POST['competence']!='' && $_POST['c_niveau']!='') {// si compétence n'est pas vide
		$competence = addslashes($_POST['competence']);
		$c_niveau = addslashes($_POST['c_niveau']);
		
		$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$c_niveau', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: competences.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_competence'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_competence'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: competences.php");//pour revenir sur la page
}//ferme le if isset
?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : <?php echo($ligne_utilisateur['pseudo']); ?></title>
</head>

<body>
<h1>Admin du site cv de <?php echo($ligne_utilisateur['pseudo']); ?> les compétences</h1>
<p>texte</p>
<hr>
<?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_competences = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
<h2>Il y a <?php echo $nbr_competences; ?> compétence<?php echo ($nbr_competences>1)?'s':'' ?> </h2>
<table border="2">
	<tr>
		<th>Compétences</th>
		<th>Niveau en %</th>
		<th>Suppression</th>
		<th>Modification</th>
	</tr>
<tr>
<?php while ($ligne_competence = $sql->fetch()) { ?>
		<td><?php echo $ligne_competence['competence']; ?></td>
		<td><?php echo $ligne_competence['c_niveau']; ?></td>
<td><a href="competencesOLD.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">supprimer</a></td>
  <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">modifier</a></td>
	</tr>
<?php }	?>
</table>
<hr>
<h3>Insertion d'une compétence</h3>
<!--formulaire d'insertion
--><form action="competencesOLD.php" method="post">
	<label for="competence">Compétence</label>
	<input type="text" name="competence" id="competence" placeholder="Insérer une compétence">
	<input type="text" name="c_niveau" id="c_niveau" placeholder="Insérer le niveau">
	<input type="submit" value="Insérez">
</form>
</body>
</html>











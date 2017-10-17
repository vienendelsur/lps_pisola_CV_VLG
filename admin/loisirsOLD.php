<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['loisir'])) {// si on a posté un loisir.
	if($_POST['loisir']!='') {// si loisir n'est pas vide
		$loisir = addslashes($_POST['loisir']);
		
		$pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: loisirs.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_loisir'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_loisir'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: loisirs.php");//pour revenir sur la page
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
<h1>Admin du site cv de <?php echo($ligne_utilisateur['pseudo']); ?> les loisirs</h1>
<p>texte</p>
<hr>
<?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_loisirs WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_loisirs = $sql->rowCount();
		//$ligne_loisir = $sql->fetch();
	?>
<h2>Il y a <?php echo $nbr_loisirs; ?> loisir<?php echo ($nbr_loisirs>1)?'s':'' ?> </h2>

<table border="2">
	<tr>
		<th>Loisirs</th>
		<th>Suppression</th>
		<th>Modification</th>
	</tr>
<tr>
<?php while ($ligne_loisir = $sql->fetch()) { ?>
		<td><?php echo $ligne_loisir['loisir']; ?></td>
<td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>">supprimer</a></td>
  <td><a href="modif_loisir.php?id_competence=<?php echo $ligne_loisir['id_loisir']; ?>">modifier</a></td>
	</tr>
<?php }	?>
</table>
<hr>
<h3>Insertion d'un loisir</h3>
<!--formulaire d'insertion
--><form action="loisirs.php" method="post">
	<label for="loisir">Loisir</label>
	<input type="text" name="loisir" id="loisir" placeholder="Insérer un loisir">
	<input type="submit" value="Insérez un loisir">
</form>
</body>
</html>











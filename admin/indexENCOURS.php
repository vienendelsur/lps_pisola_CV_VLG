<?php require 'connexion.php'; ?>
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
<h1>Admin du site cv de <?php echo($ligne_utilisateur['pseudo']); ?></h1>
<p>texte</p>
<hr>

<h2>Accueil admin</h2>
<p><a href="competencesOLD.php">compétences</a></p>
</body>
</html>

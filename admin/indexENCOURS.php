<?php require 'connexion.php'; ?>
<!doctype html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<title>Admin : <?php echo($ligne_utilisateur['pseudo']); ?></title>
</head>

<body>
<h1>Admin du site cv de <?php echo($ligne_utilisateur['pseudo']); ?></h1>
<p>texte</p>
<hr>
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_competences "); 
		$ligne_competence = $sql->fetch();
	?>
<h2>Les compétences </h2>
</body>
</html>

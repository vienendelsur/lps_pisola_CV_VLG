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
<h1>Admin <?php echo($ligne_utilisateur['prenom']); ?></h1>
</body>
</html>

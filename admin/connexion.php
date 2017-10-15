   <?php
	$hote='localhost'; // le chemin vers le serveur
	$bdd='cv_vlg'; // le nom de la base de données
	$utilisateur='root'; // le nom d'utilisateur pour se connecter
	//$passe=''; // mot de passe de l'utilisateur local PC
	$passe='root'; // mot de passe local MAC

	$pdoCV = new PDO('mysql:host='.$hote.';dbname='.$bdd, $utilisateur, $passe);
	//$pdoCV est le nom de la variable de la connexion qui sert partout où l'on doit se servir de cette connexion
	$pdoCV->exec("SET NAMES utf8");
?>

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
if(isset($_POST['competence'])){//par le nom du premier input
	$competence = addslashes($_POST['competence']);
	$c_niveau = addslashes($_POST['c_niveau']);
	$id_competence = $_POST['id_competence'];
	
	$pdoCV->exec(" UPDATE t_competences SET competence='$competence', c_niveau='$c_niveau' WHERE id_competence='$id_competence' ");
	header('location: competences.php');
	exit();	
}
//je récupère la compétence
	$id_competence = $_GET['id_competence'];// par l'id et $_GET
	$sql = $pdoCV->query(" SELECT * FROM t_competences WHERE id_competence='$id_competence' ");// la requête est égale à l'id
	$ligne_competence = $sql->fetch();
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
	
		$sql = $pdoCV->query(" SELECT * FROM t_titre_cv WHERE utilisateur_id ='1' ORDER BY id_titre_cv DESC LIMIT 1  "); 
		$ligne_titrecv = $sql->fetch();
	?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin : modif compétence ; <?php echo($ligne_utilisateur['pseudo']); ?></title>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!--Mes styles-->
<link rel="stylesheet" type="text/css" href="css/style_admin.css">
<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
<!--nav en include-->
<?php include("include_nav.php"); ?>
<div class="container-fluid geometrique"><!--container-fluid pour un container full width-->
  <div class="row">
	  <br>
    <div class="col-md-6 col-md-offset-3 fond_fonce text-center">
      <h1>Admin - Port-folio : <?php echo($ligne_utilisateur['prenom']).' '.($ligne_utilisateur['nom']); ?></h1>
    </div>
  </div>
  <hr>
</div>
<div class="container"><!--container pour un container fixed width-->
  <div class="row text-center">
    <div class="col-md-6 text-left col-lg-6">
    	<div class="panel panel-default">
		  <div class="panel-body">
			<h2>Mise à jour d'une compétence</h2>
				<form action="modif_competence.php" method="post">
					<div class="form-group">
					<label for="competence">Compétence</label>
					<input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<input type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau']; ?>" class="form-control">
					</div>
					<div class="form-group">
						<input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
					</div>
					<input type="submit" class="btn btn-info btn-block" value="Mettre à jour">
				</form>
			</div>
		</div>
	  </div>
</div>
<div class="row">
	    <!--	 footer en include-->
	<?php include("include_foot.php"); ?>
	  </div>
	<hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

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
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['f_titre'])) {// si on a posté une nouvelle comp.
	if($_POST['f_titre']!='' && $_POST['f_soustitre']!='' && $_POST['f_dates']!='' && $_POST['f_description']!='') {// si compétence n'est pas vide
		$f_titre = addslashes($_POST['f_titre']);
		$f_soustitre = addslashes($_POST['f_soustitre']);
		$f_dates = addslashes($_POST['f_dates']);
		$f_description = addslashes($_POST['f_description']);
		
		$pdoCV->exec(" INSERT INTO t_formations VALUES (NULL, '$f_titre', '$f_soustitre', '$f_dates', '$f_description', '$id_utilisateur' ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: formations.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_formation'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_formation'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_formations WHERE id_formation = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: formations.php");//pour revenir sur la page
}//ferme le if isset
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='$id_utilisateur' "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin : <?php echo($ligne_utilisateur['pseudo']); ?></title>
<!--CKEditor-->
<script src="https://cdn.ckeditor.com/4.7.3/standard/ckeditor.js"></script>

<!-- Bootstrap -->
<link href="css/bootstrap.css" rel="stylesheet">

<!--Mes styles-->
<link rel="stylesheet" type="text/css"href="css/style_admin.css">
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
    <div class="col-md-6 col-md-offset-3 fond_fonce">
      <h1 class="text-center">Admin - Port-folio : <?php echo($ligne_utilisateur['prenom']).' '.($ligne_utilisateur['nom']); ?></h1>
    </div>
  </div>
  <hr>
</div>
<div class="container"><!--container pour un container fixed width-->
  <div class="row text-left">
    <div class="col-lg-6"><?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_formations WHERE utilisateur_id ='$id_utilisateur' ");
		$sql->execute();
		$nbr_formations = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
      <h4 class="well">Il y a <?php echo $nbr_formations; ?> formation<?php echo ($nbr_formations>1)?'s':'' ?> </h4>
    </div>
  </div>
  
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-9">
    <div class="panel panel-default">
		 <div class="panel-body">
		   <p>Liste des formations</p>
		   <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Formations</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($nbr_formations = $sql->fetch()) { ?>
		<td><?php echo $nbr_formations['f_titre']; ?></td>
		<td><?php echo $nbr_formations['f_soustitre']; ?></td>
		<td colspan="2"><?php echo $nbr_formations['f_dates']; ?></td>
		</tr>
	<tr>
		<td colspan="4"><?php echo $nbr_formations['f_description']; ?></td>
		</tr>
	<tr>
		<td colspan="2"><a href="formations.php?id_formation=<?php echo $nbr_formations['id_formation']; ?>" class="btn btn-danger btn-xs">supprimer</a></td>
  		<td colspan="2"><a href="modif_formation.php?id_formation=<?php echo $nbr_formations['id_formation']; ?>" class="btn btn-success btn-xs">modifier</a></td>
  
	</tr>
<?php }	?>
</tbody>
</table>
		</div>
		</div>
   </div>
    <div class="col-sm-4 col-lg-3">
		<p class="well text-center"><span class="glyphicon glyphicon-duplicate" aria-hidden="true"></span></p>
	   </div>
   </div>
  <div class="row">
    <div class="col-lg-10">
	   
	   <div class="panel panel-default">
		 <div class="panel-body">
			<h5>Insertion d'une formation</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="formations.php" method="post">
				<div class="form-group">
				<label for="r_titre">Titre formation.</label>
				<input name="f_titre" type="text" required="required" class="form-control" id="f_titre" placeholder="Insérer le titre">
				</div>
				<div class="form-group">
				<label for="f_soustitre">Sous-titre formation</label>
				<input type="text" required="required" name="f_soustitre" id="f_soustitre" placeholder="Insérer la sous-titre de la formation" class="form-control">
				</div>
				<div class="form-group">
				<label for="f_dates">Dates</label>
				<input type="text" required="required" name="f_dates" id="f_dates" placeholder="Insérer les dates" class="form-control">
				</div>
				<div class="form-group">
				<label for="f_description">Description de la formation</label>
				<textarea name="f_description" class="form-control" id="editor1">description</textarea>
				</div>
				<script>
				CKEDITOR.replace( 'editor1' );
					</script>
				<button type="submit" class="btn btn-info btn-block">Insérez une nelle formation</button>
			</form>
		</div>
	</div> 
</div>
    <div class="col-sm-4 col-lg-2"><p class="well text-center"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></p>
	  </div>
  </div>
<hr>
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

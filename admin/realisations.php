<?php require 'connexion.php'; 

session_start();// à mettre dans toutes les pages de l'admin
	if(isset($_SESSION['connexion']) && $_SESSION['connexion']=='connecté'){//on établit que la variable de session est passée et contient bien le terme "connexion" 
		$id_utilisateur=$_SESSION['id_utilisateur'];
		$prenom=$_SESSION['prenom'];		
		$nom=$_SESSION['nom'];
		
		//echo $_SESSION['connexion'];		
        //var_dump($_SESSION);
	}else{//l'utilisateur n'est pas connecté
		header('location: sauthentifier.php');		
}//ferme le else du if isset


?>
<?php
// gestion des contenus de la BDD réalisations
//insertion d'une réalisation
if(isset($_POST['r_titre'])) {// si on a posté une nouvelle comp.
	if($_POST['r_titre']!='' && $_POST['r_soustitre']!='' && $_POST['r_dates']!='' && $_POST['r_description']!='') {// si réalisation n'est pas vide
		$r_titre = addslashes($_POST['r_titre']);
		$r_soustitre = addslashes($_POST['r_soustitre']);
		$r_dates = addslashes($_POST['r_dates']);
		$r_description = addslashes($_POST['r_description']);
		
		$pdoCV->exec(" INSERT INTO t_realisations VALUES (NULL, '$r_titre', '$r_soustitre', '$r_dates', '$r_description', '$id_utilisateur') ");// $id_utilisateur qui nous vient de la variable de session
		header("location: realisations.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 

// suppression d'une compétence
if(isset($_GET['id_realisation'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_realisation'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_realisations WHERE id_realisation = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: realisations.php");//pour revenir sur la page
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
<title>Admin : réalisations <?php echo($ligne_utilisateur['pseudo']); ?></title>

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
<?php include("../inc/include_nav.php"); ?>
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
    <div class="col-lg-8"><?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_realisations WHERE utilisateur_id ='$id_utilisateur' ");
		$sql->execute();
		$nbr_realisations = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
      <h4 class="well">Il y a <?php echo $nbr_realisations; ?> realisation<?php echo ($nbr_realisations>1)?'s':'' ?> </h4>
    </div>
  </div>
  
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-8">
   
    <div class="panel panel-default">
		 <div class="panel-body">
		<p>Liste des réalisations</p>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Réalisations</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($ligne_realisation = $sql->fetch()) { ?>
		<td><?php echo $ligne_realisation['r_titre']; ?></td>
		<td><?php echo $ligne_realisation['r_soustitre']; ?></td>
		<td><?php echo $ligne_realisation['r_dates']; ?></td>
	</tr>
	<tr>
		<td colspan="3"><?php echo $ligne_realisation['r_description']; ?></td>
	</tr>	
<td><a href="realisations.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>" class="btn btn-danger btn-xs">supprimer</a></td>
  <td><a href="modif_realisation.php?id_realisation=<?php echo $ligne_realisation['id_realisation']; ?>" class="btn btn-success btn-xs">modifier</a></td>
	</tr>
<?php }	?>
</tbody>
</table>
		</div>
		</div>
   </div>
    <div class="col-sm-4 col-lg-4 text-justify">
    <div class="panel panel-default">
		 <div class="panel-body">
			<h5>Insertion d'une réalisation</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="realisations.php" method="post">
				<div class="form-group">
				<label for="r_titre">Réalisation</label>
				<input type="text" name="r_titre" id="r_titre" placeholder="Insérer une réalisation" class="form-control">
				</div>
				<div class="form-group">
				<label for="r_soustitre">Sous-titre</label>
				<input type="text" name="r_soustitre" id="r_soustitre" placeholder="Insérer le sous-titre" class="form-control">
				</div>
				<div class="form-group">
				<label for="r_dates">Dates</label>
				<input type="text" name="r_dates" id="r_dates" placeholder="Insérer les dates" class="form-control">
				</div>
				<div class="form-group">
				<label for="r_description">Description de la réalisation</label>
				<textarea name="r_description" id="r_description" class="form-control"></textarea>
				</div>
				<button type="submit" class="btn btn-info btn-block">Insérez une nouvelle réalisation</button>
			</form>
		</div>
	</div>
</div>
</div>
  <hr>
  <div class="row">
    <div class="text-center col-md-12">
      <div class="well"><strong>Composants Bootstrap de base</strong></div>
    </div>
  </div>
  <div class="row">
    <div class="col-sm-4 text-center">
      <h4>Boutons</h4>
      <p>Quickly add buttons to your page by using the button component in the insert panel. </p>
      <button type="button" class="btn btn-info btn-sm">Info bouton</button>
      <button type="button" class="btn btn-success btn-sm">Success bouton</button>
    </div>
    <div class="text-center col-sm-4">
      <h4>Labels ou étiquettes Bootstrap</h4>
      <p>Using the insert panel, add labels to your page by using the label component.</p>
      <span class="label label-warning">Info Label</span><span class="label label-danger">Danger Label</span> </div>
    <div class="text-center col-sm-4">
      <h4><strong>Glyphicons</strong></h4>
      <p>You can also add glyphicons to your page from within the insert panel.</p>
      <div class="row">
        <div class="col-xs-4"><span class="glyphicon glyphicon-menu-hamburger" aria-hidden="true"></span></div>
        <div class="col-xs-4"><span class="glyphicon glyphicon-home" aria-hidden="true"> </span> </div>
        <div class="col-xs-4"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></div>
      </div>
    </div>
  </div>
  <hr>
	  <div class="row">
		  <!--	 footer en include-->
	<?php include("../inc/include_foot.php"); ?>
	  </div>
	<hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

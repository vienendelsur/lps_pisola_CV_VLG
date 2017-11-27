<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['e_titre'])) {// si on a posté une nouvelle comp.
	if($_POST['e_titre']!='' && $_POST['e_soustitre']!='' && $_POST['e_dates']!='' && $_POST['e_description']!='') {// si compétence n'est pas vide
		$e_titre = addslashes($_POST['e_titre']);
		$e_soustitre = addslashes($_POST['e_soustitre']);
		$e_dates = addslashes($_POST['e_dates']);
		$e_description = addslashes($_POST['e_description']);
		
		$pdoCV->exec(" INSERT INTO t_experiences VALUES (NULL, '$e_titre', '$e_soustitre', '$e_dates', '$e_description', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: experiences.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_experience'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_experience'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_experiences WHERE id_experience = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: experiences.php");//pour revenir sur la page
}//ferme le if isset
?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
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
		$sql = $pdoCV->prepare(" SELECT * FROM t_experiences WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_experiences = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
      <h4 class="well">Il y a <?php echo $nbr_experiences; ?> expérience<?php echo ($nbr_experiences>1)?'s':'' ?> </h4>
    </div>
  </div>
  
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-5">
   
    <div class="panel panel-default">
		 <div class="panel-body">
		<p>Liste des expériences</p>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Expériences pro</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($ligne_experience = $sql->fetch()) { ?>
		<td><?php echo $ligne_experience['e_titre']; ?></td>
		<td><?php echo $ligne_experience['e_soustitre']; ?></td>
		<td colspan="2"><?php echo $ligne_experience['e_dates']; ?></td>
		</tr>
	<tr>
		<td colspan="4"><?php echo $ligne_experience['e_description']; ?></td>
		</tr>
	<tr>
		<td colspan="2"><a href="experiences.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-danger btn-xs">supprimer</a></td>
  <td colspan="2"><a href="modif_experience.php?id_experience=<?php echo $ligne_experience['id_experience']; ?>" class="btn btn-success btn-xs">modifier</a></td>
  
	</tr>
<?php }	?>
</tbody>
</table>
		</div>
		</div>
   </div>
    <div class="col-sm-4 col-lg-7">
    <div class="panel panel-default">
		 <div class="panel-body">
			<h5>Insertion d'une expérience</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="experiences.php" method="post">
				<div class="form-group">
				<label for="e_titre">Titre exp.</label>
				<input name="e_titre" type="text" required="required" class="form-control" id="e_titre" placeholder="Insérer le titre">
				</div>
				<div class="form-group">
				<label for="e_soustitre">Sous-titre exp.</label>
				<input type="text" required="required" name="e_soustitre" id="e_soustitre" placeholder="Insérer le sous-titre" class="form-control">
				</div>
				<div class="form-group">
				<label for="e_dates">Dates</label>
				<input type="text" required="required" name="e_dates" id="e_dates" placeholder="Insérer les dates" class="form-control">
				</div>
				<div class="form-group">
				<label for="e_description">Description de l'exp.</label>
				<textarea name="e_description" required="required" class="form-control" id="editor1"><p>exemple</p></textarea>
				</div>
					<script>
				CKEDITOR.replace( 'editor1' );
					</script>
				<button type="submit" class="btn btn-info btn-block">Insérez une nelle expérience</button>
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

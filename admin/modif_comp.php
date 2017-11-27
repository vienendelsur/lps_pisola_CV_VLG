<?php require 'connexion.php'; ?>
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
<title>Admin : <?php echo($ligne_utilisateur['pseudo']); ?></title>

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
<?php include("inc/include_nav.php"); ?>
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
    <div class="col-md-6 text-left col-lg-5">
		<br><br>
    	<div class="panel panel-default">
		  <div class="panel-body">
			<h2>Modification d'une compétence</h2>
			<p><?php echo $ligne_competence['competence']; ?></p>
				<form action="modif_competence.php" method="post">
					<label for="competence">Compétence</label>
					<input type="text" name="competence" value="<?php echo $ligne_competence['competence']; ?>">
					<input type="number" name="c_niveau" value="<?php echo $ligne_competence['c_niveau']; ?>">
					<input hidden name="id_competence" value="<?php echo $ligne_competence['id_competence']; ?>">
					<input type="submit" value="Mettre à jour">
				</form>
			</div>
		</div>
	  </div>
    <div class="col-md-6 col-md-offset-3 col-lg-offset-0 col-lg-7"><p>&nbsp;</p><img src="img/popolasca_grate.jpg" alt="Placeholder image" class="img-responsive"></div>
</div>
  <hr>
  <div class="row">
    <div class="text-justify col-sm-4">
		<h4>Titre du Port-Folio</h4>
		<p><?php echo($ligne_titrecv['titre_cv']); ?></p></div>
    <div class="col-sm-4 text-justify">
	  <h4>Accroche</h4>
		<p><?php echo($ligne_titrecv['accroche']); ?></p>
    </div>
    <div class="col-sm-4 text-justify">
		<h4>Avatar :</h4>
		<blockquote>
			<img src="img/<?php echo($ligne_titrecv['logo']); ?>" alt="avatar patrick isola" width="175" height="147">
	  </blockquote>
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
	<?php include("inc/include_foot.php"); ?>
	  </div>
	<hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

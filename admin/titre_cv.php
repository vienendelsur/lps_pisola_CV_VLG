<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['titre_cv'])) {// si on a posté une nouvelle comp.
	if($_POST['titre_cv']!='' && $_POST['accroche']!='' && $_POST['logo']!='') {// si compétence n'est pas vide
		$titre_cv = addslashes($_POST['titre_cv']);
		$accroche = addslashes($_POST['accroche']);
		$logo = addslashes($_POST['logo']);

		$pdoCV->exec(" INSERT INTO t_titre_cv VALUES (NULL, '$titre_cv', '$accroche', '$logo', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: titre_cv.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// pas de suppression du titre du CV on prends le dernier à jour 

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
		
		$sql = $pdoCV->query(" SELECT * FROM t_titre_cv WHERE utilisateur_id ='1' ORDER BY id_titre_cv DESC LIMIT 1 ");	
		$ligne_titre_cv = $sql->fetch();
	?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin : compétences <?php echo($ligne_utilisateur['pseudo']); ?></title>

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
    <div class="col-lg-8">
      <h4 class="well">Voici le dernier titre à jour du CV</h4>
    </div>
  </div>
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-8">
	    <div class="panel panel-default">
		 <div class="panel-body">
			<table class="table table-hover">
			<thead>
				<tr>
							<th>Titre du CV</th>
							<th>son accroche</th>
							<th>Logo</th>
						</tr>
				</thead>
				<tbody>
						<tr>
								<td><?php echo $ligne_titre_cv['titre_cv']; ?></td>
								<td><?php echo $ligne_titre_cv['accroche']; ?></td>
								<td><img src="img/<?php echo $ligne_titre_cv['logo']; ?>" width="100" height="100"></td>>
						</tr>
				</tbody>
			</table>
		</div>
		</div>
   </div>
    <div class="col-sm-4 col-lg-4 text-justify">
    <div class="panel panel-default">
		 <div class="panel-body">
			<h5>Insertion et mise à jour d'un titre au cv<br> et de son accroche</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="titre_cv.php" method="post">
				<div class="form-group">
				<label for="titre_cv">Titre</label>
				<input type="text" name="titre_cv" id="titre_cv" placeholder="Insérer le titre" class="form-control" value="<?php echo $ligne_titre_cv['titre_cv']; ?>">
				</div>
				<div class="form-group">
				<label for="accroche">Accroche</label>
				<textarea name="accroche" id="accroche" class="form-control" placeholder="Insérer l'accroche"><?php echo $ligne_titre_cv['accroche']; ?></textarea>
				</div>
				<div class="form-group">
				<label for="logo">Logo</label>
				<input type="text" name="logo" id="logo" placeholder="Insérer le nom du logo" class="form-control" value="<?php echo $ligne_titre_cv['logo']; ?>">
				</div>
				<button type="submit" class="btn btn-info btn-block">Insérez les infos</button>
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

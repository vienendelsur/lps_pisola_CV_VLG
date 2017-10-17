<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['competence'])) {// si on a posté une nouvelle comp.
	if($_POST['competence']!='' && $_POST['c_niveau']!='') {// si compétence n'est pas vide
		$competence = addslashes($_POST['competence']);
		$c_niveau = addslashes($_POST['c_niveau']);
		
		$pdoCV->exec(" INSERT INTO t_competences VALUES (NULL, '$competence', '$c_niveau', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: competences.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_competence'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_competence'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_competences WHERE id_competence = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: competences.php");//pour revenir sur la page
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
<nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Toggle navigation</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="#"><?php echo($ligne_utilisateur['pseudo']); ?></a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse fond_nav" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="#">Lien<span class="sr-only">(current)</span></a></li>
        <li><a href="#">Lien</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu déroulant<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Lien 01</a></li>
            <li><a href="#">Lien 02</a></li>
            <li><a href="#">Lien 03</a></li>
            <li class="divider"></li>
            <li><a href="#">Lien à part</a></li>
            <li class="divider"></li>
            <li><a href="#">Autre lien à part</a></li>
          </ul>
        </li>
      </ul>
      <form class="navbar-form navbar-left" role="search">
        <div class="form-group">
          <input type="text" class="form-control" placeholder="recherche">
        </div>
        <button type="submit" class="btn btn-default">Envoyer</button>
      </form>
      <ul class="nav navbar-nav navbar-right">
        <li><a href="#">Lien</a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Menu déroulant<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Lien</a></li>
            <li><a href="#">Autre lien</a></li>
            <li><a href="#">Autre lien</a></li>
            <li class="divider"></li>
            <li><a href="#">Autre lien à part</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<div class="container-fluid">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 fond_fonce">
      <h1 class="text-center">Admin - site cv : <?php echo($ligne_utilisateur['prenom']).' '.($ligne_utilisateur['nom']); ?></h1>
    </div>
  </div>
  <hr>
</div>


<div class="container">
	<?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_competences WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_competences = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
  <div class="row">
    <div class="col-lg-8">
      <h5 class="well">Il y a <?php echo $nbr_competences; ?> compétence<?php echo ($nbr_competences>1)?'s':'' ?></h5>   
		<div class="row">
		<div class="text-justify col-sm-4 col-lg-12">
    <p>Liste des compétences</p>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Compétences</th>
			<th>Niveau en %</th>
			<th>Suppression</th>
			<th>Modification</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($ligne_competence = $sql->fetch()) { ?>
		<td><?php echo $ligne_competence['competence']; ?></td>
		<td><?php echo $ligne_competence['c_niveau']; ?></td>
<td><a href="competencesOLD.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">supprimer</a></td>
  <td><a href="modif_competence.php?id_competence=<?php echo $ligne_competence['id_competence']; ?>">modifier</a></td>
	</tr>
<?php }	?>
</tbody>
</table>
   </div>
		</div>
    </div>
    <!--formulaire d'insertion-->
    <div class="col-sm-4 col-lg-4 text-justify">
    <div class="panel panel-default">
		 <div class="panel-body">
			<h5>Insertion d'une compétence</h5>
			<hr>
			<form action="competences.php" method="post">
				<div class="form-group">
				<label for="competence">Compétence</label>
				<input type="text" name="competence" id="competence" placeholder="Insérer une compétence" class="form-control">
				</div>
				<div class="form-group">
				<label for="c_niveau">Niveau</label>
				<input type="text" name="c_niveau" id="c_niveau" placeholder="Insérer le niveau" class="form-control">
				</div>
				<button type="submit" class="btn btn-info btn-block">Insérez</button>
			</form>
		</div>
	</div>
</div>
</div>
  <div class="row">
   
  </div>
   <div class="row">
    
    
</div>
  <hr>
  <div class="row">
    <div class="text-center col-md-12">
      <div class="well"><strong>Composants Bootstrap de base</strong></div>
    </div>
  </div>
  <div class="row">
  
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
  <div class="row sombre">
    <div class="text-center col-md-6 col-md-offset-3">
      <h4>Pied de page </h4>
      <p>Copyright &copy; Mettre date en php &middot; DR : tous droits réservés &middot; <a href="#">Mon site</a></p>
    </div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

<?php require 'connexion.php'; ?>
<?php
// gestion des contenus de la BDD compétences
//insertion d'une compétence
if(isset($_POST['reseau'])) {// si on a posté un loisir.
	if($_POST['reseau']!='') {// si loisir n'est pas vide
		$reseau = addslashes($_POST['reseau']);
		
		$pdoCV->exec(" INSERT INTO t_reseaux VALUES (NULL, '$reseau', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: reseaux.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 
// suppression d'une compétence

if(isset($_GET['id_reseau'])) {// on récupère la comp. par son id ds l'url
	$efface = $_GET['id_reseau'];//je mets cela ds une variable
	
	$sql = " DELETE FROM t_reseaux WHERE id_reseau = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: reseaux.php");//pour revenir sur la page
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
<div class="container-fluid geometrique">
  <div class="row">
    <div class="col-md-6 col-md-offset-3 fond_fonce">
      <h1 class="text-center">Admin - site cv : <?php echo($ligne_utilisateur['prenom']).' '.($ligne_utilisateur['nom']); ?></h1>
    </div>
  </div>
  <hr>
</div>
<div class="container">
  <div class="row text-left">
    <div class="col-lg-8">
    <?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_reseaux WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_reseaux = $sql->rowCount();
		//$ligne_loisir = $sql->fetch();
	?>
      <h4 class="well">Il y a <?php echo $nbr_reseaux; ?> reseau<?php echo ($nbr_reseaux>1)?'x':'' ?> </h4>
    </div>
  </div>
  
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-8">
   
    <div class="panel panel-default">
		 <div class="panel-body">
		<p>Liste des réseaux sociaux</p>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Réseaux</th>
			<th>Suppression</th>
			<th>Modification</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($ligne_reseau = $sql->fetch()) { ?>
	<td><?php echo $ligne_reseau['reseau']; ?></td>
<td><a href="réseaux.php?id_loisir=<?php echo $ligne_reseau['id_reseau']; ?>" class="btn btn-danger btn-xs">supprimer</a></td>
  <td><a href="modif_réseau.php?id_loisir=<?php echo $ligne_reseau['id_reseau']; ?>" class="btn btn-success btn-xs">modifier</a></td>
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
			<h5>Insertion d'un réseau social</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="reseaux.php" method="post">
				<div class="form-group">
				<label for="loisir">réseau</label>
				<input type="text" name="reseau" id="reseau" placeholder="Insérer un réseau" class="form-control">
				</div>
				<button type="submit" class="btn btn-info btn-block">Insérez un réseau</button>
			</form>
		</div>
	</div>
</div>
</div>
  <hr>
  <div class="row">
    <div class="text-center col-md-12">
      <div class="well">&nbsp;</div>
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

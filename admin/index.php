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
}//ferme le else  du if isset

//pour se déconnecter de l'admin à mettre dans toutes les pages ôssi
if(isset($_GET['quitter'])){//on récupère le terme quitter dans l'url 
	
	$_SESSION['connexion']='';//on vide les variables de session
	$_SESSION['id_utilisateur']='';
	$_SESSION['prenom']='';
	$_SESSION['nom']='';
		unset($_SESSION['connexion']);
		session_destroy();
	//header('location:../index.html');	
}//ferme le if isset de la déconnexion

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='$id_utilisateur' "); 
		$ligne_utilisateur = $sql->fetch();
	
		$sql = $pdoCV->query(" SELECT * FROM t_titre_cv WHERE utilisateur_id ='$id_utilisateur' ORDER BY id_titre_cv DESC LIMIT 1  "); 
		$ligne_titrecv = $sql->fetch();
	?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin : <?php echo($ligne_utilisateur['code_postal']); ?></title>

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
    <div class="col-md-6 text-left col-lg-5">
		<br><br>
    	<div class="panel panel-default">
		  <div class="panel-body">
					<address>
				<strong><?php echo($ligne_utilisateur['prenom']).' '.($ligne_utilisateur['nom']); ?></strong><br>
				<?php echo($ligne_utilisateur['adresse']).'<br>'.($ligne_utilisateur['code_postal']).' '.($ligne_utilisateur['ville']); ?><br>
				<abbr title="Phone">Tél :</abbr> <?php echo($ligne_utilisateur['telephone']); ?>
				</address>
				<address>
				<strong><?php echo($ligne_utilisateur['pseudo']); ?></strong><br>
				<a href="mailto:<?php echo($ligne_utilisateur['email']); ?>"><?php echo($ligne_utilisateur['email']); ?></a>
				</address>
				<address>
				<a href="<?php echo($ligne_utilisateur['site_web']); ?>"><strong><?php echo($ligne_utilisateur['site_web']); ?></strong></a>
				</address>
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

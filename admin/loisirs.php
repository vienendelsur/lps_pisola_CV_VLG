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
// gestion des contenus de la BDD  : loisirs
//insertion d'un loisir
if(isset($_POST['loisir'])) {// si on a posté une nouvelle comp.
	if($_POST['loisir']!='') {// si loisir n'est pas vide
		$loisir = addslashes($_POST['loisir']);
		
		$pdoCV->exec(" INSERT INTO t_loisirs VALUES (NULL, '$loisir', '1') ");//mettre $id_utilisateur quand on l'aura dans la variable de session
		header("location: loisirs.php");//pour revenir sur la page
		exit();
	}//ferme le if n'est pas vide
}//ferme le if isset du form 

// suppression d'un loisir
if(isset($_GET['id_loisir'])) {// on récupère le loisir par son id dans l'url
	$efface = $_GET['id_loisir'];//je mets cela dans une variable
	
	$sql = " DELETE FROM t_loisirs WHERE id_loisir = '$efface' ";
	$pdoCV->query($sql);// on peut avec exec aussi si on veut
	header("location: loisirs.php");//pour revenir sur la page
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
<title>Admin : loisirs <?php echo($ligne_utilisateur['pseudo']); ?></title>

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
    <div class="col-lg-8"><?php
		$sql = $pdoCV->prepare(" SELECT * FROM t_loisirs WHERE utilisateur_id ='1' ");
		$sql->execute();
		$nbr_loisirs = $sql->rowCount();
		//$ligne_competence = $sql->fetch();
	?>
      <h4 class="well">Il y a <?php echo $nbr_loisirs; ?> loisir<?php echo ($nbr_loisirs>1)?'s':'' ?> </h4>
    </div>
  </div>
  
   <div class="row">
    <div class="text-justify col-sm-4 col-lg-8">
   
    <div class="panel panel-default">
		 <div class="panel-body">
		<p>Liste des loisirs</p>
    <table class="table table-striped table-hover">
	<thead>
		<tr>
			<th>Loisirs</th>
			<th>Suppression</th>
			<th>Modification</th>
		</tr>
	</thead>
<tbody>
<tr>
<?php while ($ligne_loisir = $sql->fetch()) { ?>
		<td><?php echo $ligne_loisir['loisir']; ?></td>
<td><a href="loisirs.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>" class="btn btn-danger btn-xs">supprimer</a></td>
  <td><a href="modif_loisir.php?id_loisir=<?php echo $ligne_loisir['id_loisir']; ?>" class="btn btn-success btn-xs">modifier</a></td>
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
			<h5>Insertion d'un loisir</h5>
			<hr>
		<!--formulaire d'insertion-->
			<form action="loisirs.php" method="post">
					<div class="form-group">
					<label for="loisir">Loisir</label>
					<input type="text" name="loisir" id="loisir" placeholder="Insérer un loisir" class="form-control">
					</div>
				<button type="submit" class="btn btn-info btn-block">Insérez un nouveau loisir</button>
			</form>
		</div>
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

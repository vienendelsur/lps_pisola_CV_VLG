<?php require 'connexion.php'; ?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs "); 
		$ligne_utilisateur = $sql->fetch();
	?>
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Admin : <?php echo($ligne_utilisateur['pseudo']); ?></title>

<!-- Bootstrap -->
<link href="../css/bootstrap.css" rel="stylesheet">

<!--Mes styles-->
<link rel="stylesheet" type="text/css" href="admin_css/style_admin.css">
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
  <div class="row text-center">
    <div class="col-md-6 col-md-offset-3">«&nbsp;Longtemps, je me suis couché de bonne heure. Parfois, à peine ma   bougie éteinte, mes yeux se fermaient si vite que je n’avais pas le   temps de me dire&nbsp;: «&nbsp;Je m’endors.&nbsp;» Et, une demi-heure après, la pensée qu’il était temps de chercher le sommeil m’éveillait&nbsp;; je voulais poser le volume que je croyais avoir encore dans les mains et souffler ma   lumière&nbsp;; je n’avais pas cessé en dormant de faire des réflexions sur ce   que je venais de lire, mais ces réflexions avaient pris un tour un peu particulier&nbsp;; il me semblait que j’étais moi-même ce dont parlait l’ouvrage&nbsp;: une église, un quatuor, la rivalité de François <abbr title="premier">Ier</abbr> et de Charles Quint. »</div>
  </div>
  <hr>
  <div class="row">
    <div class="text-justify col-sm-4">« Longtemps, je me suis couché de bonne heure. Parfois, à peine ma bougie éteinte, mes yeux se fermaient si vite que je n’avais pas le temps de me dire : « Je m’endors. » Et, une demi-heure après, la pensée qu’il était temps de chercher le sommeil m’éveillait ; je voulais poser le volume que je croyais avoir encore dans les mains et souffler ma lumière ; je n’avais pas cessé en dormant de faire des réflexions sur ce que je venais de lire, mais ces réflexions avaient pris un tour un peu particulier ; il me semblait que j’étais moi-même ce dont parlait l’ouvrage : une église, un quatuor, la rivalité de François Ier et de Charles Quint. Cette croyance survivait pendant quelques secondes à mon réveil ; elle ne choquait pas ma raison mais pesait comme des écailles sur mes yeux et les empêchait de se rendre compte que le bougeoir n’était plus allumé. Puis elle commençait à me devenir inintelligible, comme après la métempsycose les pensées d’une existence antérieure ; le sujet du livre se détachait de moi, j’étais libre de m’y appliquer ou non ; aussitôt je recouvrais la vue et j’étais bien étonné de trouver autour de moi une obscurité, douce et reposante pour mes yeux, mais peut-être plus encore pour mon esprit, à qui elle apparaissait comme une chose sans cause, incompréhensible, comme une chose vraiment obscure. Je me demandais quelle heure il pouvait être ; j’entendais le sifflement des trains qui, plus ou moins éloigné, comme le chant d’un oiseau dans une forêt, relevant les distances, me décrivait l’étendue de la campagne déserte où le voyageur se hâte vers la station prochaine ; et le petit chemin qu’il suit va être gravé dans son souvenir par l’excitation qu’il doit à des lieux nouveaux, à des actes inaccoutumés, à la causerie récente et aux adieux sous la lampe étrangère qui le suivent encore dans le silence de la nuit, à la douceur prochaine du retour1. »</div>
    <div class="col-sm-4 text-justify">Muchos años después, frente al pelotón de fusilamiento, el coronel Aureliano Buendía había de recordar aquella tarde remota en que su padre lo llevó a conocer el hielo. Macondo era entonces una aldea de 20 casas de barro y cañabrava construidas a la orilla de un río de aguas diáfanas que se precipitaban por un lecho de piedras pulidas, blancas y enormes como huevos prehistóricos. El mundo era tan reciente, que muchas cosas carecían de nombre, y para mencionarlas había que señalarlas con el dedo</div>
    <div class="col-sm-4 text-justify">« Longtemps, je me suis couché de bonne heure. Parfois, à peine ma bougie éteinte, mes yeux se fermaient si vite que je n’avais pas le temps de me dire : « Je m’endors. » Et, une demi-heure après, la pensée qu’il était temps de chercher le sommeil m’éveillait ; je voulais poser le volume que je croyais avoir encore dans les mains et souffler ma lumière ; je n’avais pas cessé en dormant de faire des réflexions sur ce que je venais de lire, mais ces réflexions avaient pris un tour un peu particulier ; il me semblait que j’étais moi-même ce dont parlait l’ouvrage : une église, un quatuor, la rivalité de François Ier et de Charles Quint. Cette croyance survivait pendant quelques secondes à mon réveil ; elle ne choquait pas ma raison mais pesait comme des écailles sur mes yeux et les empêchait de se rendre compte que le bougeoir n’était plus allumé. Puis elle commençait à me devenir inintelligible, comme après la métempsycose les pensées d’une existence antérieure ; le sujet du livre se détachait de moi, j’étais libre de m’y appliquer ou non ; aussitôt je recouvrais la vue et j’étais bien étonné de trouver autour de moi une obscurité, douce et reposante pour mes yeux, mais peut-être plus encore pour mon esprit, à qui elle apparaissait comme une chose sans cause, incompréhensible, comme une chose vraiment obscure. Je me demandais quelle heure il pouvait être ; j’entendais le sifflement des trains qui, plus ou moins éloigné, comme le chant d’un oiseau dans une forêt, relevant les distances, me décrivait l’étendue de la campagne déserte où le voyageur se hâte vers la station prochaine ; et le petit chemin qu’il suit va être gravé dans son souvenir par l’excitation qu’il doit à des lieux nouveaux, à des actes inaccoutumés, à la causerie récente et aux adieux sous la lampe étrangère qui le suivent encore dans le silence de la nuit, à la douceur prochaine du retour1. »</div>
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
  <div class="row sombre">
    <div class="text-center col-md-6 col-md-offset-3">
      <h4>Pied de page </h4>
      <p>Copyright &copy; Mettre date en php &middot; DR : tous droits réservés &middot; <a href="#">Mon site</a></p>
    </div>
  </div>
  <hr>
</div>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="../js/jquery-1.11.3.min.js"></script>

<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="../js/bootstrap.js"></script>
</body>
</html>

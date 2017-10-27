<!--navigation en include-->
  <nav class="navbar navbar-default">
  <div class="container-fluid"> 
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#defaultNavbar1"><span class="sr-only">Nav</span><span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span></button>
      <a class="navbar-brand" href="index.php"><?php echo($ligne_utilisateur['pseudo']); ?></a></div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse fond_nav" id="defaultNavbar1">
      <ul class="nav navbar-nav">
        <li class="active"><a href="profil.php">Mon profil<span class="sr-only">(current)</span></a></li>
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Parcours<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="experiences.php">Expériences</a></li>
            <li><a href="formations.php">Formations</a></li>
            <li><a href="realisations.php">Réalisations</a></li>
            <li class="divider"></li>
            <li><a href="#">Lien à part</a></li>
            <li class="divider"></li>
            <li><a href="#">Autre lien à part</a></li>
          </ul>
        </li>
         <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false">Compétences et divers<span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="competences.php">Compétences</a></li>
            <li><a href="loisirs.php">Loisirs</a></li>
            <li><a href="reseaux.php">Réseaux sociaux</a></li>
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
        <li class="dropdown"><a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-expanded="false"><?php echo($ligne_utilisateur['prenom']); ?><span class="caret"></span></a>
          <ul class="dropdown-menu" role="menu">
            <li><a href="#">Déconnexion</a></li>
            <li class="divider"></li>
            <li><a href="#">Site public</a></li>
          </ul>
        </li>
      </ul>
    </div>
    <!-- /.navbar-collapse --> 
  </div>
  <!-- /.container-fluid --> 
</nav>
<!--fin de la navigation-->

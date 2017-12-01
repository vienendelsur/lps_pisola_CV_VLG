<?php require 'admin/connexion.php'; 

session_start();// à mettre dans toutes les pages de l'admin
	
//pour se déconnecter de l'admin à mettre dans toutes les pages ??? ou juste sur la page login.php ?
if(isset($_GET['quitter'])){//on récupère le terme quitter dans l'url 
	
	$_SESSION['connexion']='';//on vide les variables de session
	$_SESSION['id_utilisateur']='';
	$_SESSION['prenom']='';
	$_SESSION['nom']='';
		
		unset($_SESSION['connexion']);
		session_destroy();
	//header('location:../index.php');	
}//ferme le if isset de la déconnexion

?>
<!DOCTYPE html>
<html lang="fr">
<head>
<meta charset="utf-8">
<meta http-equiv="X-UA-Compatible" content="IE=edge">
<meta name="viewport" content="width=device-width, initial-scale=1">
<title>Portfolio</title>

<!-- Bootstrap -->
<link rel="stylesheet" href="css/bootstrap.css">

<!-- HTML5 shim and Respond.js for IE8 support of HTML5 elements and media queries -->
<!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
<!--[if lt IE 9]>
      <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
      <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
</head>
<body>
	<?php
		$sql = $pdoCV->query(" SELECT * FROM t_utilisateurs WHERE id_utilisateur ='1' "); 
		$ligne_utilisateur = $sql->fetch();
	
		$sql = $pdoCV->query(" SELECT * FROM t_titre_cv WHERE utilisateur_id ='1' ORDER BY id_titre_cv DESC LIMIT 1  "); 
		$ligne_titrecv = $sql->fetch();
	?>

  <div class="container">
    <hr>
    <div class="row">
      <div class="col-xs-6">
        <h1><?php echo($ligne_utilisateur['pseudo']); ?></h1>
      </div>
      <div class="col-xs-6">
        <p class="text-right"><a href="">Download my Resume <span class="glyphicon glyphicon-download-alt" aria-hidden="true"></span></a></p>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-xs-7">
        <div class="media">
          <div class="media-left"> <a href="#"> <img class="media-object img-rounded" src="images/115X115.gif" alt="..."> </a> </div>
          <div class="media-body">
            <h2 class="media-heading">Web Developer</h2>
            Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aliquam, neque, in, accusamus optio architecto debitis dolor animi placeat ut ab corporis laboriosam itaque. Nobis, sapiente quo dolorum ut quod possimus doloremque suscipit ad doloribus quam dolor </div>
        </div>
      </div>
      <div class="col-xs-5 well">
        <div class="row">
          <div class="col-lg-6">
            <h4><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> : 123-456-7890</h4>
          </div>
          <div class="col-lg-6">
            <h4><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span> : john@example.com</h4>
          </div>
        </div>
        <div class="row">
          <div class="col-lg-6">
            <h4><span class="glyphicon glyphicon-map-marker" aria-hidden="true"></span> : San Francisco, CA</h4>
          </div>
          <div class="col-lg-6">
            <h4><span class="glyphicon glyphicon-phone" aria-hidden="true"></span> : 123-456-7890</h4>
          </div>
        </div>
      </div>
    </div>
    <hr>
    <div class="row">
      <div class="col-sm-8 col-lg-7">
        <h2>Education</h2>
        <hr>
        <div class="row">
        	<div class="col-xs-6"><h4>College of Web Design</h4></div>
        	<div class="col-xs-6">
        	  <h4 class="text-right"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Jan 2002 - Dec 2006</h4>
        	</div>
        </div>
        <h4><span class="label label-default">Bachelors</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, recusandae, corporis, tempore nam fugit deleniti sequi excepturi quod repellat laboriosam soluta laudantium amet dicta non ratione distinctio nihil dignissimos esse!</p>
        <div class="row">
          <div class="col-xs-6">
            <h4>University of Web Design</h4>
          </div>
          <div class="col-xs-6">
            <h4 class="text-right"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Jan 2006 - Dec 2008</h4>
          </div>
        </div>
        <h4><span class="label label-default">Masters</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, recusandae, corporis, tempore nam fugit deleniti sequi excepturi quod repellat laboriosam soluta laudantium amet dicta non ratione distinctio nihil dignissimos esse!</p>
</div>
      <div class="col-sm-4 col-lg-5">
        <h2>Skill Set</h2>
        <hr>
        <!-- Green Progress Bar -->
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="85" aria-valuemin="0" aria-valuemax="100" style="width: 85%"> HTML</div>
        </div>
        <!-- Blue Progress Bar -->
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="80" aria-valuemin="0" aria-valuemax="100" style="width: 80%"> CSS</div>
        </div>
        <!-- Yellow Progress Bar -->
        <div class="progress">
          <div class="progress-bar progress-bar-success" role="progressbar" aria-valuenow="70" aria-valuemin="0" aria-valuemax="100" style="width: 70%"> JAVASCRIPT</div>
        </div>
        <!-- Red Progress Bar -->
        <div class="progress">
          <div class="progress-bar progress-bar-info" role="progressbar" aria-valuenow="60" aria-valuemin="0" aria-valuemax="100" style="width: 60%"> PHP</div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-warning" role="progressbar" aria-valuenow="55" aria-valuemin="0" aria-valuemax="100" style="width: 55%"> WORDPRESS</div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"> PHOTOSHOP</div>
        </div>
        <div class="progress">
          <div class="progress-bar progress-bar-danger" role="progressbar" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100" style="width: 50%"> ILLUSTRATOR</div>
        </div>
</div>
    </div>
    <hr>
    <h2>Work Experience</h2>
<hr>
    <div class="row">
      <div class="col-lg-6">
        <div class="row">
          <div class="col-xs-5">
            <h4>ABC Corp.</h4>
          </div>
<div class="col-xs-5">
            <h4 class="text-right"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Jan 2002 - Dec 2006</h4>
          </div>
        </div>
        <h4><span class="label label-default">Web Developer</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, recusandae, corporis, tempore nam fugit deleniti sequi excepturi quod repellat laboriosam soluta laudantium amet dicta non ratione distinctio nihil dignissimos esse!</p>
        <ul>
        	<li>Lorem ipsum dolor sit amet.</li>
        	<li>Lorem ipsum dolor sit amet, consectetur.</li>
        	<li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
        </ul>
      </div>
      <div class="col-lg-6">
        <div class="row">
          <div class="col-xs-5">
            <h4>XYZ Corp.</h4>
          </div>
          <div class="col-xs-6">
            <h4 class="text-right"><span class="glyphicon glyphicon-calendar" aria-hidden="true"></span> Jan 2002 - Dec 2006</h4>
          </div>
        </div>
        <h4><span class="label label-default">Senior Web Developer</span></h4>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Sint, recusandae, corporis, tempore nam fugit deleniti sequi excepturi quod repellat laboriosam soluta laudantium amet dicta non ratione distinctio nihil dignissimos esse!</p>
        <ul>
          <li>Lorem ipsum dolor sit amet.</li>
          <li>Lorem ipsum dolor sit amet, consectetur.</li>
          <li>Lorem ipsum dolor sit amet, consectetur adipisicing.</li>
        </ul>
      </div>
    </div>
    <hr>
    <h2>Portfolio</h2>
    <hr>
    <div class="container">
    	<div class="row">
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""><hr class="hidden-lg"></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""><hr class="hidden-lg"></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6 hidden-lg"><img src="images/300X200.gif" alt=""></div>
    	</div>
        <hr>
        <div class="row">
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""><hr class="hidden-lg"></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""><hr class="hidden-lg"></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6"><img src="images/300X200.gif" alt=""></div>
    		<div class="col-lg-4 col-sm-6 col-xs-6 hidden-lg"><img src="images/300X200.gif" alt=""></div>
    	</div>
    </div>
    <hr>
    <h2>Contact</h2>
    <hr>
  </div>
  <div class="container">
  <div class="row">
    <div class="col-lg-offset-3 col-xs-12 col-lg-6">
      <div class="jumbotron">
        <div class="row text-center">
          <div class="text-center col-xs-12 col-sm-12 col-md-12 col-lg-12"> </div>
          <div class="text-center col-lg-12"> 
            <!-- CONTACT FORM https://github.com/jonmbake/bootstrap3-contact-form -->
            <form role="form" id="feedbackForm" class="text-center">
              <div class="form-group">
                <label for="name">Name</label>
                <input type="text" class="form-control" id="name" name="name" placeholder="Name">
                <span class="help-block" style="display: none;">Please enter your name.</span></div>
              <div class="form-group">
                <label for="email">E-Mail</label>
                <input type="email" class="form-control" id="email" name="email" placeholder="Email Address">
                <span class="help-block" style="display: none;">Please enter a valid e-mail address.</span></div>
              <div class="form-group">
                <label for="message">Message</label>
                <textarea rows="10" cols="100" class="form-control" id="message" name="message" placeholder="Message"></textarea>
                <span class="help-block" style="display: none;">Please enter a message.</span></div>
              <span class="help-block" style="display: none;">Please enter a the security code.</span>
              <button type="submit" id="feedbackSubmit" class="btn btn-primary btn-lg" style=" margin-top: 10px;"> Send</button>
            </form>
            <!-- END CONTACT FORM --> 
          </div>
        </div>
      </div>
    </div>
  </div>
</div>
<hr>
<footer class="text-center">
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
        <p>Copyright © MyWebsite. All rights reserved.</p>
      </div>
    </div>
  </div>
</footer>
<!-- jQuery (necessary for Bootstrap's JavaScript plugins) --> 
<script src="js/jquery-1.11.3.min.js"></script> 
<!-- Include all compiled plugins (below), or include individual files as needed --> 
<script src="js/bootstrap.js"></script>
</body>
</html>

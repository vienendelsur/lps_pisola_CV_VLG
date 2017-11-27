<footer>
	<div class="text-center col-md-6 col-md-offset-3 sombre">
		<h4>Pied de page </h4>
		<h4>test</h4>
		<p>Copyright &copy; &middot; DR : tous droits réservés &middot; <a href="#">Mon site</a></p>
		<p><?php 
			$date = date("d-m-Y");
			$heure = date("H:i");
			Print("Nous sommes le $date, il est $heure");
			?>
		</p>
	</div>
  <hr>
</footer>
<?php
//Contact.class.php
// Une classe peut contenir plusieurs méthodes (ou fonctions)
// par ex. une classe voiture peut avoir comme méthodes 'freiner' et 'accélerer' et quand je créé un objet de la classe voiture, par ex. un 308 ou une porsche qui auront les  fonctionnalités de la classe voiture comme freiner' et 'accélerer'
class Contact {//variable privée, on ne peut modifier la variable qu'en passant par les méthodes de la class Contact
	
	private $c_nom;
	private $c_email;
	private $c_sujet;
	private $c_message;
	
	
	//fonction d'insertion dans ma BDD
	public function insertContact($c_nom, $c_email, $c_sujet, $c_message) {
		$this->c_nom = strip_tags($c_nom);// on récupère les données rentrées pas l'utilisateur
		$this->c_email = strip_tags($c_email);
		$this->c_sujet = strip_tags($c_sujet);
		$this->c_message = strip_tags($c_message);
		
		require('admin/connexion.php');//on a besoin de se connecter maintenant
		
		$requete = $pdoCV->prepare(" INSERT INTO t_contacts (c_nom, c_email, c_sujet, c_message) VALUES (:c_nom, :c_email, :c_sujet, :c_message) ");// 
		$requete->execute([//on créé une requête et on l'exécute
			':c_nom' => $this->c_nom,
			':c_email' => $this->c_email,
			':c_sujet' => $this->c_sujet,
			':c_message' => $this->c_message]);
		//on ferme la requête par une protection contre les injections
		$requete->closeCursor();
	}//fin public function insertContact
		
}//fin class Contact

?>
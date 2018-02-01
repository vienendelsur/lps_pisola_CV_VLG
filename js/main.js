// JavaScript Document pisola
// merci Ali !
//$(function(){//pour vérifier que le js se charge
//	console.log("coucou");	
//});
$(function(){//vérifier que le chargement de la page se fait correctement
	//on met un écouteur d'évènement, au click sur les balises a pour cela il faut ajouter une class .supr sur la balise a
	$('.supr').on("click",function(evenement){
		evenement.preventDefault();//cela empêche le comportement par défaut du a
		if(confirm('Voulez effacer cette info ?')){//on vérifie si l'utilisateur a cliqué, oui ? on fait le contenu du if ; non ? on fait rien
			//console.log('alors ? ');
			var lien = $(this).attr('href');
			//console.log(lien);
			window.location.href=lien;
		} 	
	});
});


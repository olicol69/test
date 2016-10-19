<?php
	//controleur liste personnel
	
	// inclure les fonctions modele et vue
	include "./modeles/personnel/listepersonnel.php";
	include "./vues/personnel/listepersonnel.php";

	//récupérer la liste des personnels
	$donnees = recupererListePersonnel();
	
	// afficher la vue des personnels
	afficherListePersonnel($donnees);
	
?>
